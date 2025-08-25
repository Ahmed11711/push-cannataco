<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Resources\TrackResource;


class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::with([
            'countrySender',
            'stateSender',
            'citySender',
            'countryReceived',
            'stateReceived',
            'cityReceived',
            'shippingMethods'
        ])->get();

        return TrackResource::collection($tracks);
    }
}
