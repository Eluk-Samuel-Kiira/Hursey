<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currencies = Currency::all();
        
        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'currencyIndexTable':
                return view('settings.currency.currency-component', [
                    'currencies' => $currencies,
                ]);
            default:
                return view('settings.currency-index', [
                    'currencies' => $currencies,
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'currency_code' => ['required', 'string', 'max:12', 'unique:currencies,currency_code'],
            'symbol' => ['required', 'string', 'max:5'],
            'default' => ['nullable', 'boolean'],  
            'status' => [
                'nullable',
                'in:active,inactive',
                function ($attribute, $value, $fail) use ($request) {
                    // Custom validation: If default is true, status cannot be 'inactive'
                    if ($request->default && $value === 'inactive') {
                        $fail(__('roles._currency_default_status')); // Custom error message
                    }
                },
            ],
        ]);

        if (isset($validatedData['default']) && $validatedData['default']) {
            Currency::where('default', 1)->update(['default' => 0]);
            $validatedData['default'] = 1;
        } else {
            $validatedData['default'] = 0;
        }

        if (Currency::create($validatedData)) {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('roles.currency_created'),
                'component' => 'currencyIndexTable',
                'redirect' => route('currency.index'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => __('auth.smthin_wrong'),
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validatedData = $request->validate([
            'currency_code' => ['required', 'string', 'max:12',],
            'symbol' => ['required', 'string', 'max:5'],
            'default' => ['nullable', 'boolean'],  
            'status' => [
                'nullable',
                'in:active,inactive',
                function ($attribute, $value, $fail) use ($request) {
                    // Custom validation: If default is true, status cannot be 'inactive'
                    if ($request->default && $value === 'inactive') {
                        $fail(__('roles._currency_default_status')); // Custom error message
                    }
                },
            ],
        ]);

        $currencies = Currency::all();

        if (isset($validatedData['default']) && $validatedData['default']) {
            // Update all currencies to set default to 0
            $currencies->each(function ($currency) {
                $currency->update(['default' => 0]);
            });
            $validatedData['default'] = 1; // Set the new currency as default
        } else {
            $validatedData['default'] = 0;
        }

        $currency = $currencies->find($id);
        if ($currency && $currency->update($validatedData)) {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('roles.currency_updated'),
                'component' => 'currencyIndexTable',
                'redirect' => route('currency.index'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => __('auth.smthin_wrong'),
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currency = Currency::find($id);

        if ($currency && $currency->default !== 1) {
            $currency->delete();
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('roles.currency_updated'),
                'component' => 'currencyIndexTable',
                'redirect' => route('currency.index'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => __('roles.default_not_delete'),
            ]);
        }

    }
}
