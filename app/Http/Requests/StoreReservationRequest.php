<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'date_begin' => 'required|date',
            'date_end' => 'required|date',
            'days_reserved' => 'required|integer',
            'total_price' => 'required|integer',
        ];
    }

    private function durationValidation(): bool
    {
        $begin = strtotime($this['date_begin']);
        $end = strtotime($this['date_end']);
        $days = round(($end - $begin) / (60 * 60 * 24));
        return $this['days_reserved'] == $days;
    }

    private function priceValidation()
    {
        $car = DB::table('cars')->find($this['car_id']);
        return ($car->price * $this['days_reserved']) == $this['total_price'];
    }

    private function availableValidation(): bool
    {
        $overlapping_reservations = DB::table('reservations')
            ->whereBetween('reservations.date_begin', [date($this['date_begin']), date($this['date_end'])])
            ->orWhereBetween('reservations.date_end', [date($this['date_begin']), date($this['date_end'])])
            ->select('car_id')
            ->distinct();

        $free_cars = DB::table('cars')
            ->where('cars.active', 1)
            ->where('id', $this['car_id'])
            ->whereNotIn('id', $overlapping_reservations)
            ->select('cars.*')
            ->get();

        return count($free_cars) == 1;
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (date($this['date_begin']) > date($this['date_end'])) {
                    $validator->errors()->add(
                        'date_begin',
                        'Invalid date range!'
                    );
                }
                if (!$this->durationValidation()) {
                    $validator->errors()->add(
                        'days_reserved',
                        'Reservation duration mismatch!'
                    );
                }
                if (!$this->priceValidation()) {
                    $validator->errors()->add(
                        'total_price',
                        'Price mismatch!'
                    );
                }
                if (!$this->availableValidation()) {
                    $validator->errors()->add(
                        'car_id',
                        'Car unavailable!'
                    );
                }
            }
        ];
    }
}
