<?php

namespace App\Http\Controllers\API\Society;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Spot;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnArgument;

class IndexController extends Controller
{
    /**
     * @return mixed
     */
    public function getCurrentSociety(): mixed
    {
        return Auth::user()->society;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultations(): \Illuminate\Http\JsonResponse
    {
        $society = $this->getCurrentSociety();
        $consultations = $society->consultations;
        return $this->responseApiModel($consultations, 'consultations');
    }

    public function storeConsultation(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'dieases_history' => 'required|string|max:255',
            'current_symthoms' => 'required|string|max:255',
        ]);
        if ($validate->fails()) return $this->responseApiValidate($validate->errors());
        $model = new Consultation();
        $model->current_symthoms = $request->current_symthoms;
        $model->dieases_history = $request->dieases_history;
        $model->society_id = $this->getCurrentSociety()->id;
        try {
            $model->save();
        } catch (\Throwable $th) {
            return $this->responseApiMessage(false, "Failed creating your consultations. try again.", $th->getMessage(), 422);
        }
        return $this->responseApiMessage(true, "Success creating your consultations. Please wait the doctor accept.");
    }

    public  function spots()
    {
        $society = $this->getCurrentSociety();
        $spots = Spot::where('regional_id', $society->regional_id)->with(['spot_vaccines', 'regional'])->get();
        foreach ($spots as $spot) {
            foreach ($spot->spot_vaccines as $spot_vaccine) {
                $spot_vaccine->vaccine;
            }
        }
        return $this->responseApiModel($spots, 'spots');
    }

    public function spot($id, $date)
    {
        $society = $this->getCurrentSociety();
        $spot = Spot::findOrFail($id);
        if ($spot->regional_id != $society->regional_id) return $this->responseApiMessage(false, "This spot is not in your regional", 404);
        $vaccinations = Vaccination::where('date', $date)->get();
        return $this->responseApiModel(compact('spot', 'vaccinations'));
    }

    public function vaccinations()
    {
        $society = $this->getCurrentSociety();
        $vaccinations = $society->vaccinations;
        foreach ($vaccinations as $vaccination) {
            $vaccination->spot;
        }
        return $this->responseApiModel($vaccinations, 'vaccinations');
    }

    public function storeVaccination(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'dose' => 'required',
            'date' => 'required|date|after:yesterday',
            'step' => 'required',
            'spot_id' => 'required|exists:spots,id',
        ]);
        if ($validate->fails()) return $this->responseApiValidate($validate->errors());
        $model = new Vaccination();
        $model->dose = $request->dose;
        $model->date = $request->date;
        $model->step = $request->step;
        $model->society_id = $this->getCurrentSociety()->id;
        $model->spot_id = $request->spot_id;
        try {
            $model->save();
        } catch (\Throwable $th) {
            return $this->responseApiMessage(false, "Failed registering your vaccinations." . $th->getMessage(), 422);
        }
        return $this->responseApiMessage(true, "Success registering your vaccinations");
    }
}
