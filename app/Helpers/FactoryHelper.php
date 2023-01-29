<?php
    
    namespace App\Helpers;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    
    class FactoryHelper
    {
        /**
         * Get random model ID
         *
         * @param string |HasFactory $model
         *
         */
        public static function getRandomModelId(string $model): mixed
        {
            /** get model count */
            $count = $model::query()->count();
            if ($count === 0) {
                /** If model count is 0, create new record and retrieve it\'s ID */
                return $model::factory()->create()->id;
            }
            else {
                /** generate random number between 1 & model count */
                return rand(1, $count);
            }
        }
        
    }