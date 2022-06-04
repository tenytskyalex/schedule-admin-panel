<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ReflectionClass;

abstract class AdminBaseController extends Controller
{
    const BASE_MODEL_NAMESPACE = 'App\Models\\';

    abstract protected function getModel(): string;

    public function index() {
        $model = $this->getModel();
        $items = call_user_func([$model, 'all']);
        if($items->count() > 0) {
            $attributes = $items[0]->getAttributes();
            $headers = array_keys($attributes);
        } else {
            $headers = [];
        }
        return view('admin.layouts.index', [
            'create_route' => $this->getBaseRouteName().'.create',
            'update_route' => $this->getBaseRouteName().'.edit',
            'items' => $items, 'headers' => $headers
        ]);
    }

    public function create() {
        $model = $this->getModel();
        $fields = (new $model)->getFillable();

        $relations = [];
        $reflection = new ReflectionClass($model);
        foreach ($reflection->getMethods() as $method) {
            $returnType = $method->getReturnType();
            if(!$returnType || !is_subclass_of($returnType->getName(), Relation::class)) {
                continue;
            }
            $relationModel = new (self::BASE_MODEL_NAMESPACE.ucfirst($method->getName()))();
            $relations[lcfirst($method->getName()).'_id'] = $relationModel::all();
            unset($fields[lcfirst($method->getName()).'_id']);
        }

        return view('admin.layouts.create', ['store_route' => $this->getBaseRouteName().'.store', 'fields' => $fields, 'relations' => $relations]);
    }

    public function store(Request $request) {
        $model = $this->getModel();
        $record = new $model();
        $attributes = Validator::make($request->all(), call_user_func([$model, 'getValidationRules']))->validated();
        foreach ($attributes as $field => $value) {
            $record->setAttribute($field, $value);
        }
        $record->save();

        return redirect()->route($this->getBaseRouteName().'.edit', $record)->with('success', 'Successfully created');
    }

    public function edit($recordId) {
        $model = new ($this->getModel());
        $record = $model::find($recordId);
        $fields = [];
        foreach ($model->getFillable() as $field) {
            $fields[$field] = $record->getAttribute($field);
        }

        $relations = [];
        $reflection = new ReflectionClass($model);
        foreach ($reflection->getMethods() as $method) {
            $returnType = $method->getReturnType();
            if(!$returnType || !is_subclass_of($returnType->getName(), Relation::class)) {
                continue;
            }
            $relationModel = new (self::BASE_MODEL_NAMESPACE.ucfirst($method->getName()))();
            $relations[lcfirst($method->getName()).'_id'] = $relationModel::all();
            unset($fields[lcfirst($method->getName()).'_id']);
        }

        return view('admin.layouts.edit', ['record' => $record, 'fields' => $fields,
            'update_route' => $this->getBaseRouteName().'.update',
            'destroy_route' => $this->getBaseRouteName().'.destroy',
            'relations' => $relations
        ]);
    }

    public function update($recordId, Request $request) {
        $model = $this->getModel();
        $record = $model::find($recordId);
        $attributes = Validator::make($request->all(), $record::getValidationRules())->validated();
        foreach ($attributes as $field => $value) {
            $record->setAttribute($field, $value);
        }
        $record->save();

        return redirect()->route($this->getBaseRouteName().'.edit', $record)->with('success', 'Successfully updated');
    }

    public function destroy($recordId) {
        $model = $this->getModel();
        $model::destroy($recordId);
        return redirect()->route($this->getBaseRouteName().'.index')->with('success', 'Successfully deleted');
    }

    protected function getClassName(): string {
        $explodedNamespace = explode('\\', $this->getModel());
        return $explodedNamespace[count($explodedNamespace)-1];
    }

    protected function getBaseRouteName(): string {
        $className = $this->getClassName();
        return lcfirst($className).'s';
    }
}
