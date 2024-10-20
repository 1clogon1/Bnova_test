<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Services\PhoneService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{

    /**
     * Получение данных гостя или всех гостей.
     * Если передан ID, возвращает данные конкретного гостя, иначе возвращает список всех гостей.
     *
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGuest($id = null)
    {
        $debugData = $this->startDebug();
        try {
            if (!empty($id)) {
                $guest = Guest::findOrFail($id);
                return $this->jsonResponse('success', $guest, $debugData);
            } else {
                $guests = Guest::all();
                return $this->jsonResponse('success', $guests, $debugData);
            }
        }
        catch (ModelNotFoundException $e) {
            return $this->jsonResponse('error', null, $debugData, 'Guest not found', 404);
        }
        catch (Exception $e) {
            Log::error('Error retrieving guests: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return $this->jsonResponse('error', null, $debugData, 'Error request', 500, $e->getMessage());
        }
    }

    /**
     * Добавление нового гостя.
     * Выполняет валидацию данных и сохраняет нового гостя в базе данных.
     * Если страна не указана, определяется по номеру телефона.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addGuest(Request $request)
    {
        $debugData = $this->startDebug();
        try {
            $phone = preg_replace('/[^0-9+]/', '', $request->phone);
            $request->merge(['phone' => $phone]);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100|min:3',
                'surname' => 'required|string|max:100|min:3',
                'phone' => 'required|string|max:15|min:10|unique:guests',
                'email' => 'nullable|string|email|max:255|min:5|unique:guests',
                'country' => 'string|max:100'
            ]);

            if ($validator->fails()) {
                return $this->jsonResponse('error',  $validator->errors(), $debugData, 'Error validate.', 422);
            }

            $data = $request->all();

            if (empty($request->country)) {
                $phoneService = new PhoneService();
                $country = $phoneService->getCountryByPhone($request->phone);
                $data['country'] = $country;
            }

            Guest::create($data);

            return $this->jsonResponse('success',  null, $debugData, 'Guest added successfully', 201);

        }
        catch (Exception $e) {
            Log::error('Error when adding a guest: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e,
            ]);

            return $this->jsonResponse('error', null, $debugData, 'Error request', 500, $e->getMessage());
        }
    }

    /**
     * Обновление данных гостя по его ID.
     * Валидирует и обновляет данные гостя, если он существует.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateGuest(Request $request, $id)
    {
        $debugData = $this->startDebug();
        try {
            if(!empty($request->phone)){
                $phone = preg_replace('/[^0-9+]/', '', $request->phone);
                $request->merge(['phone' => $phone]);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:100|min:3',
                'surname' => 'sometimes|string|max:100|min:3',
                'phone' => 'sometimes|string|max:15|min:10|unique:guests,phone,' . $id,
                'email' => 'nullable|string|email|max:255|min:5|unique:guests,email,' . $id,
                'country' => 'sometimes|string|max:100'
            ]);

            if ($validator->fails()) {
                return $this->jsonResponse('error', $validator->errors(), $debugData, 'Error validate', 422);
            }

            $guest = Guest::findOrFail($id);
            $data = $request->all();

            if (empty($request->country)) {
                $phoneService = new PhoneService();
                $country = $phoneService->getCountryByPhone($request->phone);
                $data['country'] = $country;
            }

            $guest->update($data);

            return $this->jsonResponse('success',  $guest, $debugData, 'Guest updated successfully', 200);
        }
        catch (ModelNotFoundException $e) {
            return $this->jsonResponse('error', null, $debugData, 'Guest not found', 404);
        }
        catch (Exception $e) {
            Log::error('Error when updating guest: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e,
            ]);

            return $this->jsonResponse('error', null, $debugData, 'Error request', 500, $e->getMessage());
        }
    }

    /**
     * Удаление гостя по его ID.
     * Выполняет удаление гостя из базы данных.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGuest($id)
    {
        $debugData = $this->startDebug();
        try {
            $guest = Guest::findOrFail($id);
            $guest->delete();

            $response = response()->json([
                'status' => 'success',
                'message' => 'Guest deleted successfully',
            ], 200);
            return $this->addDebugHeaders($response, $debugData);
        }
        catch (ModelNotFoundException $e) {
            return $this->jsonResponse('error', null, $debugData, 'Guest not found', 404);
        }
        catch (Exception $e) {
            Log::error('Error deleting guest: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return $this->jsonResponse('error', null, $debugData, 'Error request', 500, $e->getMessage());
        }
    }


}
