<?php

namespace App\Http\Controllers;


use App\Http\Requests\Guest\StoreRequest;
use App\Http\Requests\Guest\UpdateRequest;
use App\Http\Resources\Guest\GuestResource;
use App\Models\Country;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GuestController extends Controller
{

    public function index()
    {
        $guests = Guest::all();
        return GuestResource::collection($guests);
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if (strpos($data['phone'], ' ') !== false) {
            list($countryCode, $phoneNumber) = explode(' ', $data['phone'], 2);

            $country = Country::where('code', $countryCode)->first();

            if ($country) {
                if (empty($data['country_id'])) {
                    $data['country_id'] = $country->id;
                }
            }
        }

        $guest = Guest::create($data);

        return GuestResource::make($guest);
    }


    public function show(Guest $guest)
    {
        return GuestResource::make($guest);
    }


    public function update(UpdateRequest $request, Guest $guest)
    {
        $data = $request->validated();

        if (strpos($data['phone'], ' ') !== false) {
            list($countryCode, $phoneNumber) = explode(' ', $data['phone'], 2);

            $country = Country::where('code', $countryCode)->first();

            if ($country) {
                if (empty($data['country_id'])) {
                    $data['country_id'] = $country->id;
                }
            }
        }

        $guest->update($data);
        return GuestResource::make($guest);
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
