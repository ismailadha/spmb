<?php

return [
    'accepted'             => 'Isian :attribute harus diterima.',
    'accepted_if'          => 'Isian :attribute harus diterima ketika :other adalah :value.',
    'active_url'           => 'Isian :attribute bukan URL yang sah.',
    'after'                => 'Isian :attribute harus tanggal setelah :date.',
    'after_or_equal'       => 'Isian :attribute harus tanggal setelah atau sama dengan :date.',
    'alpha'                => 'Isian :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => 'Isian :attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'            => 'Isian :attribute hanya boleh berisi huruf dan angka.',
    'array'                => 'Isian :attribute harus berupa array.',
    'ascii'                => 'Isian :attribute hanya boleh berisi karakter alfanumerik dan simbol single-byte.',
    'before'               => 'Isian :attribute harus tanggal sebelum :date.',
    'before_or_equal'      => 'Isian :attribute harus tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'Isian :attribute harus antara :min dan :max.',
        'file'    => 'Isian :attribute harus antara :min dan :max kilobita.',
        'string'  => 'Isian :attribute harus antara :min dan :max karakter.',
        'array'   => 'Isian :attribute harus antara :min dan :max item.',
    ],
    'boolean'              => 'Isian :attribute harus berupa true atau false.',
    'can'                  => 'Isian :attribute mengandung nilai yang tidak sah.',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'contains'             => 'Isian :attribute kekurangan nilai yang diperlukan.',
    'current_password'     => 'Kata sandi salah.',
    'date'                 => 'Isian :attribute bukan tanggal yang valid.',
    'date_equals'          => 'Isian :attribute harus tanggal yang sama dengan :date.',
    'date_format'          => 'Isian :attribute tidak sesuai dengan format :format.',
    'decimal'              => 'Isian :attribute harus memiliki :decimal tempat desimal.',
    'declined'             => 'Isian :attribute harus ditolak.',
    'declined_if'          => 'Isian :attribute harus ditolak ketika :other adalah :value.',
    'different'            => 'Isian :attribute dan :other harus berbeda.',
    'digits'               => 'Isian :attribute harus berupa :digits digit.',
    'digits_between'       => 'Isian :attribute harus antara :min dan :max digit.',
    'dimensions'           => 'Isian :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => 'Isian :attribute memiliki nilai yang duplikat.',
    'doesnt_end_with'      => 'Isian :attribute tidak boleh diakhiri dengan salah satu dari berikut: :values.',
    'doesnt_start_with'    => 'Isian :attribute tidak boleh diawali dengan salah satu dari berikut: :values.',
    'email'                => 'Isian :attribute harus berupa alamat email yang valid.',
    'ends_with'            => 'Isian :attribute harus diakhiri dengan salah satu dari berikut: :values.',
    'enum'                 => 'Isian :attribute yang dipilih tidak valid.',
    'exists'               => 'Isian :attribute yang dipilih tidak valid.',
    'extensions'           => 'Isian :attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file'                 => 'Isian :attribute harus berupa sebuah berkas.',
    'filled'               => 'Isian :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Isian :attribute harus lebih besar dari :value.',
        'file'    => 'Isian :attribute harus lebih besar dari :value kilobita.',
        'string'  => 'Isian :attribute harus lebih besar dari :value karakter.',
        'array'   => 'Isian :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'Isian :attribute harus lebih besar dari atau sama dengan :value.',
        'file'    => 'Isian :attribute harus lebih besar dari atau sama dengan :value kilobita.',
        'string'  => 'Isian :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array'   => 'Isian :attribute harus memiliki :value item atau lebih.',
    ],
    'hex_color'            => 'Isian :attribute harus berupa warna heksadesimal yang valid.',
    'image'                => 'Isian :attribute harus berupa gambar.',
    'in'                   => 'Isian :attribute yang dipilih tidak valid.',
    'in_array'             => 'Isian :attribute tidak ada di :other.',
    'integer'              => 'Isian :attribute harus berupa bilangan bulat.',
    'ip'                   => 'Isian :attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => 'Isian :attribute harus berupa string JSON yang valid.',
    'list'                 => 'Isian :attribute harus berupa list.',
    'lowercase'            => 'Isian :attribute harus berupa huruf kecil.',
    'lt' => [
        'numeric' => 'Isian :attribute harus kurang dari :value.',
        'file'    => 'Isian :attribute harus kurang dari :value kilobita.',
        'string'  => 'Isian :attribute harus kurang dari :value karakter.',
        'array'   => 'Isian :attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'Isian :attribute harus kurang dari atau sama dengan :value.',
        'file'    => 'Isian :attribute harus kurang dari atau sama dengan :value kilobita.',
        'string'  => 'Isian :attribute harus kurang dari atau sama dengan :value karakter.',
        'array'   => 'Isian :attribute tidak boleh memiliki lebih dari :value item.',
    ],
    'mac_address'          => 'Isian :attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'numeric' => 'Isian :attribute maksimal :max.',
        'file'    => 'Isian :attribute maksimal :max kilobita.',
        'string'  => 'Isian :attribute maksimal :max karakter.',
        'array'   => 'Isian :attribute maksimal :max item.',
    ],
    'max_digits'           => 'Isian :attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes'                => 'Isian :attribute harus berupa berkas berjenis: :values.',
    'mimetypes'            => 'Isian :attribute harus berupa berkas berjenis: :values.',
    'min' => [
        'numeric' => 'Isian :attribute minimal :min.',
        'file'    => 'Isian :attribute minimal :min kilobita.',
        'string'  => 'Isian :attribute minimal :min karakter.',
        'array'   => 'Isian :attribute minimal :min item.',
    ],
    'min_digits'           => 'Isian :attribute harus memiliki setidaknya :min digit.',
    'missing'              => 'Isian :attribute harus hilang.',
    'missing_if'           => 'Isian :attribute harus hilang ketika :other adalah :value.',
    'missing_unless'       => 'Isian :attribute harus hilang kecuali :other adalah :value.',
    'missing_with'         => 'Isian :attribute harus hilang ketika :values ada.',
    'missing_with_all'     => 'Isian :attribute harus hilang ketika :values ada.',
    'multiple_of'          => 'Isian :attribute harus merupakan kelipatan dari :value.',
    'not_in'               => 'Isian :attribute yang dipilih tidak valid.',
    'not_regex'            => 'Format isian :attribute tidak valid.',
    'numeric'              => 'Isian :attribute harus berupa angka.',
    'password' => [
        'letters' => 'Isian :attribute harus mengandung setidaknya satu huruf.',
        'mixed'   => 'Isian :attribute harus mengandung setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers' => 'Isian :attribute harus mengandung setidaknya satu angka.',
        'symbols' => 'Isian :attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => 'Isian :attribute telah muncul dalam kebocoran data. Harap pilih :attribute yang berbeda.',
    ],
    'present'              => 'Isian :attribute harus ada.',
    'present_if'           => 'Isian :attribute harus ada ketika :other adalah :value.',
    'present_unless'       => 'Isian :attribute harus ada kecuali :other adalah :value.',
    'present_with'         => 'Isian :attribute harus ada ketika :values ada.',
    'present_with_all'     => 'Isian :attribute harus ada ketika :values ada.',
    'prohibited'           => 'Isian :attribute dilarang.',
    'prohibited_if'        => 'Isian :attribute dilarang ketika :other adalah :value.',
    'prohibited_unless'    => 'Isian :attribute dilarang kecuali :other ada di :values.',
    'prohibits'            => 'Isian :attribute melarang :other untuk ada.',
    'regex'                => 'Format isian :attribute tidak valid.',
    'required'             => 'Isian :attribute wajib diisi.',
    'required_array_keys'  => 'Isian :attribute harus berisi entri untuk: :values.',
    'required_if'          => 'Isian :attribute wajib diisi ketika :other adalah :value.',
    'required_if_accepted' => 'Isian :attribute wajib diisi ketika :other diterima.',
    'required_if_declined' => 'Isian :attribute wajib diisi ketika :other ditolak.',
    'required_unless'      => 'Isian :attribute wajib diisi kecuali :other ada di :values.',
    'required_with'        => 'Isian :attribute wajib diisi ketika :values ada.',
    'required_with_all'    => 'Isian :attribute wajib diisi ketika :values ada.',
    'required_without'     => 'Isian :attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => 'Isian :attribute wajib diisi ketika tidak ada :values yang ada.',
    'same'                 => 'Isian :attribute dan :other harus cocok.',
    'size' => [
        'numeric' => 'Isian :attribute harus berukuran :size.',
        'file'    => 'Isian :attribute harus berukuran :size kilobita.',
        'string'  => 'Isian :attribute harus berukuran :size karakter.',
        'array'   => 'Isian :attribute harus berisi :size item.',
    ],
    'starts_with'          => 'Isian :attribute harus diawali dengan salah satu dari berikut: :values.',
    'string'               => 'Isian :attribute harus berupa string.',
    'timezone'             => 'Isian :attribute harus berupa zona waktu yang valid.',
    'unique'               => ':attribute sudah digunakan.',
    'uploaded'             => 'Pengunggahan :attribute gagal.',
    'uppercase'            => 'Isian :attribute harus berupa huruf besar.',
    'url'                  => 'Isian :attribute harus berupa URL yang valid.',
    'ulid'                 => 'Isian :attribute harus berupa ULID yang valid.',
    'uuid'                 => 'Isian :attribute harus berupa UUID yang valid.',

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

    'attributes' => [
        'email' => 'alamat email',
        'password' => 'kata sandi',
        'name' => 'nama',
        'username' => 'nama pengguna',
        // Masukkan nama field yang ingin diterjemahkan di sini
    ],

];
