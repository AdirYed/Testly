<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | as the size rules. Feel free to tweak each of these messages.
  |
  */

  'accepted' => 'שדה זה חייב להיות מסומן.',
  'active_url' => 'שדה זה הוא לא כתובת אתר תקנית.',
  'after' => 'שדה זה חייב להיות תאריך אחרי :date.',
  'after_or_equal' => 'שדה זה חייב להיות תאריך מאוחר או שווה ל :date.',
  'alpha' => 'שדה זה יכול להכיל אותיות בלבד.',
  'alpha_dash' => 'שדה זה יכול להכיל אותיות, מספרים ומקפים בלבד.',
  'alpha_num' => 'שדה זה יכול להכיל אותיות ומספרים בלבד.',
  'array' => 'שדה זה חייב להיות מערך.',
  'before' => 'שדה זה חייב להיות תאריך לפני :date.',
  'before_or_equal' => 'שדה זה חייב להיות תאריך מוקדם או שווה ל :date.',
  'between' => [
    'numeric' => 'שדה זה חייב להיות בין :min ל-:max.',
    'file' => 'שדה זה חייב להיות בין :min ל-:max קילובייטים.',
    'string' => 'שדה זה חייב להיות בין :min ל-:max תווים.',
    'array' => 'שדה זה חייב להיות בין :min ל-:max פריטים.',
  ],
  'boolean' => 'שדה זה חייב להיות אמת או שקר.',
  'confirmed' => 'שדה האישור של זה לא תואם.',
  'date' => 'שדה זה אינו תאריך תקני.',
  'date_equals' => 'על ה זה להיות תאריך שווה ל- :date.',
  'date_format' => 'שדה זה לא תואם את הפורמט :format.',
  'different' => 'שדה זה ושדה :other חייבים להיות שונים.',
  'digits' => 'שדה זה חייב להיות בעל :digits ספרות.',
  'digits_between' => 'שדה זה חייב להיות בין :min ו-:max ספרות.',
  'dimensions' => 'שדה זה מימדי התמונה לא תקינים',
  'distinct' => 'שדה זה קיים ערך כפול.',
  'email' => 'שדה זה חייב להיות כתובת אימייל תקנית.',
  'ends_with' => 'The זה must end with one of the following: :values',
  'exists' => 'בחירת ה-זה אינה תקפה.',
  'file' => 'שדה זה חייב להיות קובץ.',
  'filled' => 'שדה זה הוא חובה.',
  'gt' => [
    'numeric' => 'על ה זה להיות גדול יותר מ- :value.',
    'file' => 'על ה זה להיות גדול יותר מ- :value קילו-בתים.',
    'string' => 'על ה זה להיות גדול יותר מ- :value תווים.',
    'array' => 'על ה זה לכלול יותר מ- :value פריטים.',
  ],
  'gte' => [
    'numeric' => 'על ה זה להיות גדול יותר או שווה ל- :value.',
    'file' => 'על ה זה להיות גדול יותר או שווה ל- :value קילו-בתים.',
    'string' => 'על ה זה להיות גדול יותר או שווה ל- :value תווים.',
    'array' => 'ה זה חייב לכלול :value פריטים או יותר.',
  ],
  'image' => 'שדה זה חייב להיות תמונה.',
  'in' => 'בחירת ה-זה אינה תקפה.',
  'in_array' => 'שדה זה לא קיים ב:other.',
  'integer' => 'שדה זה חייב להיות מספר שלם.',
  'ip' => 'שדה זה חייב להיות כתובת IP תקנית.',
  'ipv4' => 'שדה זה חייב להיות כתובת IPv4 תקנית.',
  'ipv6' => 'שדה זה חייב להיות כתובת IPv6 תקנית.',
  'json' => 'שדה זה חייב להיות מחרוזת JSON תקנית.',
  'lt' => [
    'numeric' => 'על ה זה להיות נמוך יותר מ- :value.',
    'file' => 'על ה זה להיות קטן יותר מ- :value קילו-בתים.',
    'string' => 'על ה זה להכיל פחות מ- :value תווים.',
    'array' => 'על ה זה לכלול פחות מ- :value פריטים.',
  ],
  'lte' => [
    'numeric' => 'על ה זה להיות נמוך או שווה ל- :value.',
    'file' => 'על ה זה להיות קטן יותר או שווה ל- :value קילו-בתים.',
    'string' => 'על ה זה להכיל :value תווים או פחות.',
    'array' => 'ה זה לא יכול לכלול יותר מאשר :value פריטים.',
  ],
  'max' => [
    'numeric' => 'שדה זה אינו יכול להיות גדול מ-:max.',
    'file' => 'שדה זה לא יכול להיות גדול מ-:max קילובייטים.',
    'string' => 'שדה זה לא יכול להיות גדול מ-:max תווים.',
    'array' => 'שדה זה לא יכול להכיל יותר מ-:max פריטים.',
  ],
  'mimes' => 'שדה זה צריך להיות קובץ מסוג: :values.',
  'mimetypes' => 'שדה זה צריך להיות קובץ מסוג: :values.',
  'min' => [
    'numeric' => 'שדה זה חייב להיות לפחות :min.',
    'file' => 'שדה זה חייב להיות לפחות :min קילובייטים.',
    'string' => 'שדה זה חייב להיות לפחות :min תווים.',
    'array' => 'שדה זה חייב להיות לפחות :min פריטים.',
  ],
  'not_in' => 'בחירת ה-זה אינה תקפה.',
  'not_regex' => 'הפורמט של זה איננו חוקי.',
  'numeric' => 'שדה זה חייב להיות מספר.',
  'present' => 'שדה זה חייב להיות קיים.',
  'regex' => 'שדה זה בעל פורמט שאינו תקין.',
  'required' => 'שדה זה הוא חובה.',
  'required_if' => 'שדה זה נחוץ כאשר :other הוא :value.',
  'required_unless' => 'שדה זה נחוץ אלא אם כן :other הוא בין :values.',
  'required_with' => 'שדה זה נחוץ כאשר :values נמצא.',
  'required_with_all' => 'שדה זה נחוץ כאשר :values נמצא.',
  'required_without' => 'שדה זה נחוץ כאשר :values לא בנמצא.',
  'required_without_all' => 'שדה זה נחוץ כאשר אף אחד מ-:values נמצאים.',
  'same' => 'שדה זה ו-:other חייבים להיות זהים.',
  'size' => [
    'numeric' => 'שדה זה חייב להיות :size.',
    'file' => 'שדה זה חייב להיות :size קילובייטים.',
    'string' => 'שדה זה חייב להיות :size תווים.',
    'array' => 'שדה זה חייב להכיל :size פריטים.',
  ],
  'starts_with' => 'ה זה חייב להתחיל עם אחד מהבאים: :values',
  'string' => 'שדה זה חייב להיות מחרוזת.',
  'timezone' => 'שדה זה חייב להיות איזור תקני.',
  'unique' => 'שדה זה כבר תפוס.',
  'uploaded' => 'שדה זה ארעה שגיאה בעת ההעלאה.',
  'url' => 'שדה זה בעל פורמט שאינו תקין.',
  'uuid' => 'ה זה חייב להיות מזהה ייחודי אוניברסלי (UUID) חוקי.',

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention "attribute.rule" to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
  */

  'custom' => [
    'attribute-name' => [
      'rule-name' => 'custom-message',
    ],
  ],

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap attribute place-holders
  | with something more reader friendly such as E-Mail Address instead
  | of "email". This simply helps us make messages a little cleaner.
  |
  */

  'attributes' => [
  ],
];
