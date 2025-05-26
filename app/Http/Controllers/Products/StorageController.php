<?php

namespace App\Http\Controllers\Products;

use App\Services\Storages\StorageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->storageService->index());
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function show(string $id): JsonResponse
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid',
        ])->validate();

        try {
            return response()->json($this->storageService->show($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' =>'Storage not found'], 404);
        }
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, string $id): JsonResponse
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid',
        ])->validate();

        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        try {
            return response()->json($this->storageService->update($request, $id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Could not update: Storage not found'], 404);
        }
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function delete(string $id): JsonResponse
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid',
        ])->validate();

        try {
            return response()->json($this->storageService->delete($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Storage not found'], 404);
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
