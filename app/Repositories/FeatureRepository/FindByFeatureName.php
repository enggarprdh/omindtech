<?php

namespace App\Repositories\FeatureRepository;

use App\Feature as Feature;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class FindByFeatureName
{
    protected $feature;
    protected $featureName;

    public function __construct($featureName)
    {
        $this->feature = DB::table('feature');
        $this->featureName = $featureName;
    }
    public function Get()
    {
        $data = Feature::where('featureName', $this->featureName)
            ->first();
        return $data;
    }
}
