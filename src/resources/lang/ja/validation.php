<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute を承認してください。',
    'active_url' => ':attribute が有効なURLではありません。',
    'after' => ':attribute には、:date 以降の日付を指定してください。',
    'after_or_equal' => ':attribute には、:date 以降の日付を指定してください。',
    'alpha' => ':attribute には、アルファベッドのみ使用できます。',
    'alpha_dash' => ":attribute には、英字、数字、ダッシュ(-)、アンダースコア(_)が使用できます。",
    'alpha_num' => ':attribute には、英字と数字が使用できます。',
    'array' => ':attribute には、配列を指定してください。',
    'before' => ':attribute には、:date 以前の日付を指定してください。',
    'before_or_equal' => ':attribute には、:date 以前の日付を指定してください。',
    'between' => [
        'numeric' => ':attribute は、:min から :max の間で指定してください。',
        'file' => ':attribute は、:min KBから :max KBの間で指定してください。',
        'string' => ':attribute は、:min 文字から :max 文字の間で指定してください。',
        'array' => ':attribute は、:min 個から :max 個の間で指定してください。',
    ],
    'boolean' => ':attribute には、true か false を指定してください。',
    'confirmed' => ':attribute と、確認フィールドとが、一致していません。',
    'date' => ':attribute は有効な日付ではありません。',
    'date_equals' => ':attribute には、:date と同じ日付を指定してください。',
    'date_format' => ':attribute は、:format 書式と一致していません。',
    'different' => ':attribute と :other には、異なるものを指定してください。',
    'digits' => ':attribute は、:digits 桁で指定してください。',
    'digits_between' => ':attribute は、:min 桁から :max 桁の間で指定してください。',
    'dimensions' => ':attribute の画像サイズが無効です。',
    'distinct' => ':attribute には、異なる値を指定してください。',
    'email' => ':attribute には、有効なメールアドレスを指定してください。',
    'ends_with' => ':attribute は、:values のいずれかで終わらなければなりません。',
    'exists' => '選択された :attribute は、有効ではありません。',
    'file' => ':attribute にはファイルを指定してください。',
    'filled' => ':attribute には、値を指定してください。',
    'gt' => [
        'numeric' => ':attribute には、:value より大きな値を指定してください。',
        'file' => ':attribute には、:value KBより大きなファイルを指定してください。',
        'string' => ':attribute は、:value 文字より多く指定してください。',
        'array' => ':attribute には、:value 個より多くのアイテムを指定してください。',
    ],
    'gte' => [
        'numeric' => ':attribute には、:value 以上の値を指定してください。',
        'file' => ':attribute には、:value KB以上のファイルを指定してください。',
        'string' => ':attribute は、:value 文字以上で指定してください。',
        'array' => ':attribute には、:value 個以上のアイテムを指定してください。',
    ],
    'image' => ':attribute には、画像を指定してください。',
    'in' => '選択された :attribute は、有効ではありません。',
    'in_array' => ':attribute は、:other に存在しません。',
    'integer' => ':attribute には、整数を指定してください。',
    'ip' => ':attribute には、有効なIPアドレスを指定してください。',
    'ipv4' => ':attribute には、有効なIPv4アドレスを指定してください。',
    'ipv6' => ':attribute には、有効なIPv6アドレスを指定してください。',
    'json' => ':attribute には、有効なJSON文字列を指定してください。',
    'lt' => [
        'numeric' => ':attribute には、:value より小さな値を指定してください。',
        'file' => ':attribute には、:value KBより小さなファイルを指定してください。',
        'string' => ':attribute は、:value 文字より少なく指定してください。',
        'array' => ':attribute には、:value 個より少ないアイテムを指定してください。',
    ],
    'lte' => [
        'numeric' => ':attribute には、:value 以下の値を指定してください。',
        'file' => ':attribute には、:value KB以下のファイルを指定してください。',
        'string' => ':attribute は、:value 文字以下で指定してください。',
        'array' => ':attribute には、:value 個以下のアイテムを指定してください。',
    ],
    'max' => [
        'numeric' => ':attribute には、:max 以下の値を指定してください。',
        'file' => ':attribute には、:max KB以下のファイルを指定してください。',
        'string' => ':attribute は、:max 文字以下で指定してください。',
        'array' => ':attribute は、:max 個以下で指定してください。',
    ],
    'mimes' => ':attribute には、:values タイプのファイルを指定してください。',
    'mimetypes' => ':attribute には、:values タイプのファイルを指定してください。',
    'min' => [
        'numeric' => ':attribute には、:min 以上の値を指定してください。',
        'file' => ':attribute には、:min KB以上のファイルを指定してください。',
        'string' => ':attribute は、:min 文字以上で指定してください。',
        'array' => ':attribute には、:min 個以上のアイテムを指定してください。',
    ],
    'multiple_of' => ':attribute には、:value の倍数を指定してください。',
    'not_in' => '選択された :attribute は、有効ではありません。',
    'not_regex' => ':attribute の書式が無効です。',
    'numeric' => ':attribute には、数値を指定してください。',
    'password' => 'パスワードが違います。',
    'present' => ':attribute には、現在の値を指定してください。',
    'regex' => ':attribute に正しい書式を指定してください。',
    'required' => ':attribute は必須です。',
    'required_if' => ':other が :value の場合、:attribute を指定してください。',
    'required_unless' => ':other が :values でない場合、:attribute を指定してください。',
'required_with' => ':values を指定する場合は、:attribute も指定してください。',
'required_with_all' => ':values を指定する場合は、:attribute も指定してください。',
'required_without' => ':values を指定しない場合は、:attribute を指定してください。',
'required_without_all' => ':values のどれも指定しない場合は、:attribute を指定してください。',
'same' => ':attribute と :other が一致していません。',
'size' => [
    'numeric' => ':attribute には、:size を指定してください。',
    'file' => ':attribute には、:size KBのファイルを指定してください。',
    'string' => ':attribute は、:size 文字で指定してください。',
    'array' => ':attribute は、:size 個で指定してください。',
],
'starts_with' => ':attribute は、:values のいずれかで始まらなければなりません。',
'string' => ':attribute には、文字を指定してください。',
'timezone' => ':attribute には、有効なタイムゾーンを指定してください。',
'unique' => '指定の :attribute は既に使用されています。',
'uploaded' => ':attribute のアップロードに失敗しました。',
'url' => ':attribute は、有効なURL形式で指定してください。',
'uuid' => ':attribute には、有効なUUIDを指定してください。',

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
| The following language lines are used to swap our attribute placeholder
| with something more reader friendly such as "E-Mail Address" instead
| of "email". This simply helps us make our message more expressive.
|
*/

'attributes' => [],

];