<?php

namespace Viropanel\Admin\Models\Traits;

use Illuminate\Support\Facades\App;

trait Translatable
{
    protected $defaultLocale = 'en';
    public function __($originFieldname)
    {
        $locale = App::getLocale() ?? $this->defaultLocale;
        if ($locale === 'ru') {
            $fieldName = $originFieldname . '_ru';
        } elseif ($locale === 'ro') {
            $fieldName = $originFieldname . '_ro';
        } else {
            $fieldName = $originFieldname;
        }

        if (!in_array($fieldName, array_keys($this->attributes))) {
            throw new \LogicWxception('no such attribute for model ' . get_class($this));
        }

        if ($locale === 'ru' && is_null($this->$fieldName) || empty($this->$fieldName)) {
            return $this->$originFieldname;
        }

        return $this->$fieldName;
    }
}
