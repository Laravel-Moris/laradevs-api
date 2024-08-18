<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenApi\Attributes as OAT;

class DeveloperController extends Controller
{
    #[OAT\Get(
        path: '/developers',
        operationId: 'indexDevelopers',
        description: 'Get a paginated list of all developers',
        summary: 'List all developers',
        tags: ['Developers'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Successful operation',
                content: new OAT\JsonContent()
            )
        ]
    )]
    public function index(): LengthAwarePaginator
    {
        return Developer::paginate();
    }

    #[OAT\Get(
        path: '/developers/{developer}',
        operationId: 'showDeveloper',
        description: 'Get a single developer by ID',
        summary: 'Get a developer',
        tags: ['Developers'],
        parameters: [
            new OAT\Parameter(
                name: 'developer',
                description: 'ID of developer to return',
                in: 'path',
                required: true,
                schema: new OAT\Schema(type: 'integer', format: 'int64'),
                example: 1,
            )
        ],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Successful operation',
                content: new OAT\JsonContent()
            ),
            new OAT\Response(
                response: 404,
                description: 'Developer not found',
                content: new OAT\JsonContent()
            )
        ]
    )]
    public function show(Developer $developer): Developer
    {
        return $developer;
    }

    #[OAT\Post(
        path: '/developers',
        operationId: 'storeDeveloper',
        description: 'Create a new developer',
        summary: 'Create a developer',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                ref: '#/components/schemas/Developer',
                type: 'object'
            )
        ),
        tags: ['Developers'],
        responses: [
            new OAT\Response(
                response: 201,
                description: 'Successful operation',
                content: new OAT\JsonContent()
            )
        ]
    )]
    public function store(Request $request): Developer
    {
        $data = $request->validate([
            'name' =>[ 'required', 'string'],
            'bio' => ['required', 'string'],
        ]);

        $developer = Developer::create($data);
        $developer->createdBy()->associate($request->user())->save();

        return $developer;
    }

    #[OAT\Put(
        path: '/developers/{developer}',
        operationId: 'updateDeveloper',
        description: 'Update a developer by ID',
        summary: 'Update a developer',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                ref: '#/components/schemas/Developer',
                type: 'object'
            )
        ),
        tags: ['Developers'],
        parameters: [
            new OAT\Parameter(
                name: 'developer',
                description: 'ID of developer to update',
                in: 'path',
                required: true,
                schema: new OAT\Schema(type: 'integer', format: 'int64'),
                example: 1,
            )
        ],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Successful operation',
                content: new OAT\JsonContent()
            ),
            new OAT\Response(
                response: 404,
                description: 'Developer not found',
                content: new OAT\JsonContent()
            )
        ]
    )]
    public function update(Request $request, Developer $developer): Developer
    {
        $data = $request->validate([
            'name' =>[ 'required', 'string'],
            'bio' => ['required', 'string'],
        ]);

        $developer->update($data);

        return $developer;
    }

    #[OAT\Delete(
        path: '/developers/{developer}',
        operationId: 'destroyDeveloper',
        description: 'Delete a developer by ID',
        summary: 'Delete a developer',
        tags: ['Developers'],
        parameters: [
            new OAT\Parameter(
                name: 'developer',
                description: 'ID of developer to delete',
                in: 'path',
                required: true,
                schema: new OAT\Schema(type: 'integer', format: 'int64'),
                example: 1,
            ),
        ],
        responses: [
            new OAT\Response(
                response: 204,
                description: 'Successful operation',
                content: new OAT\JsonContent()
            ),
            new OAT\Response(
                response: 404,
                description: 'Developer not found',
                content: new OAT\JsonContent()
            )
        ]
    )]
    public function destroy(Developer $developer): Response
    {
        $developer->delete();

        return response()->noContent();
    }
}
