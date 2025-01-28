<?php
    
    namespace App\Http\Requests;
    
    use App\Models\Car;
    use App\Rules\PhoneRule;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rules\File;
    
    class StoreCarRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            return true;
        }
        
        public function rules(): array
        {
            return [
              'maker_id' => 'required',
              'modelo_id' => 'required',
              'year' => ['required', 'integer', 'min:'.Car::getMinYear(), 'max:'.date('Y')],
                //'user-id' => 'required',
              'price' => 'required|integer|min:100',
              'vin' => 'required|string',//|size:17
              'mileage' => 'required|integer|min:10',
              'car_type_id' => 'required|exists:car_types,id',
              'fuel_type_id' => 'required|exists:fuel_types,id',
              'city_id' => 'required|exists:cities,id',
              'address' => 'required|string',
              'phone' => new PhoneRule(), //'required|string|min:9',
              'description' => 'nullable|string',
              'published_at' => 'nullable|string',
              'features' => 'array',
              'features.*' => 'string',
              'images' => 'nullable|array',
              'images.*' => File::image()
                // Minimum size of the image should be 512
//			    ->min(512)
                ->max(2048)
                // We set the maximum width and height of the image to be 1000px
//			    ->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(1000))
            ];
        }
        
        public function messages(): array
        {
            return [
                //  'required' => 'This :attribute is required',
              'maker_id.required' => 'La MARCA es obligatoria',
            ];
        }
        
    }
