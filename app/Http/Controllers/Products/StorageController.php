<?php

namespace App\Http\Controllers\Products;

use App\Services\Storages\StorageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StorageController extends Controller
{
    public function __construct(
        private readonly StorageService $storageService
    )
    {

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $storage = $this->storageService->store($request);

        return response()->json($storage);
    }
}
