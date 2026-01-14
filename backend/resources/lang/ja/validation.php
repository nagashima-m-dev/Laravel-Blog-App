<?php

return [
    'required' => ':attributeは必須項目です。',
    'string' => ':attributeは文字列で入力してください。',
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],
    'unique' => ':attributeはすでに使用されています。',
    'confirmed' => ':attributeが確認用と一致しません。',

    'attributes' => [
        'title' => 'タイトル',
        'body' => '本文',
        'name' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'login' => 'メールアドレスまたはユーザー名',
    ],
];
