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

    'accepted' => ':attribute phải được chấp nhận.',
    'accepted_if' => ':attribute phải được chấp nhận khi :other là :value.',
    'active_url' => ':attribute không phải là một URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => ':attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => ':attribute chỉ có thể chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ có thể chứa các chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => ':attribute phải nằm trong khoảng :min và :max.',
        'file' => ':attribute phải nằm trong khoảng :min và :max kilobytes.',
        'string' => ':attribute phải nằm trong khoảng :min và :max ký tự.',
        'array' => ':attribute phải nằm trong khoảng :min và :max phần tử.',
    ],
    'boolean' => ':attribute phải là true hoặc false.',
    'confirmed' => ':attribute không khớp.',
    'current_password' => 'Mật khẩu hiện tại không đúng.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng :date.',
    'date_format' => ':attribute không giống định dang :format.',
    'declined' => ':attribute phải bị từ chối.',
    'declined_if' => ':attribute phải bị từ chối khi :other là :value.',
    'different' => ':attribute và :other phải khác.',
    'digits' => ':attribute phải gồm :digits chữ số.',
    'digits_between' => ':attribute phải nằm trong khoảng :min và :max chữ số.',
    'dimensions' => ':attribute có kích thước không hợp lệ.',
    'distinct' => ':attribute trường có giá trị trùng lặp.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng: :values.',
    'enum' => ':attribute đã chọn không hợp lệ.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'file' => ':attribute phải là một tập tin.',
    'filled' => ':attribute không được bỏ trống.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'string' => ':attribute phải nhiều hơn :value ký tự.',
        'array' => ':attribute phải nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải nhiều hơn hoặc bằng :value ký tự.',
        'array' => ':attribute phải nhiều hơn hoặc bằng :value phần tử.',
    ],
    'image' => ':attribute phải là một hình ảnh.',
    'in' => ':attribute đã chọn không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'string' => ':attribute phải ít hơn :value ký tự.',
        'array' => ':attribute phải ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải ít hơn hoặc bằng :value ký tự.',
        'array' => ':attribute phải ít hơn hoặc bằng :value phần tử.',
    ],
    'mac_address' => ':attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => ':attribute không được nhiều hơn :max ký tự.',
        'array' => ':attribute không được nhiều hơn :max items.',
    ],
    'mimes' => ':attribute phải có định dạng: :values.',
    'mimetypes' => ':attribute phải có định dạng: :values.',
    'min' => [
        'numeric' => ':attribute không được nhỏ hơn :min.',
        'file' => ':attribute không được nhỏ hơn :min kilobytes.',
        'string' => ':attribute không được nhiều hơn :min ký tự.',
        'array' => ':attribute không được nhiều hơn :min phần tử.',
    ],
    'multiple_of' => ':attribute phải là bội số của :value.',
    'not_in' => ':attribute đã chọn không hợp lệ.',
    'not_regex' => ':attribute không đúng định dạng.',
    'numeric' => ':attribute phải là số.',
    'password' => 'Mật khẩu không đúng.',
    'present' => ':attribute phải được cung cấp.',
    'prohibited' => ':attribute bị cấm.',
    'prohibited_if' => ':attribute bị cấm khi :other là :value.',
    'prohibited_unless' => ':attribute bị cấm trừ khi :other là :values.',
    'prohibits' => ':attribute cấm :other được nhập.',
    'regex' => ':attribute định dạng không hợp lệ.',
    'required' => 'Vui lòng nhập :attribute.',
    'required_array_keys' => ':attribute phải chứa các mục nhập cho: :values.',
    'required_if' => 'Vui lòng nhập :attribute khi có :other là :value.',
    'required_unless' => 'Vui lòng nhập :attribute trừ khi :other là :values.',
    'required_with' => 'Vui lòng nhập :attribute khi có :values.',
    'required_with_all' => 'Vui lòng nhập :attribute khi có :values.',
    'required_without' => 'Vui lòng nhập :attribute khi không có :values.',
    'required_without_all' => 'Vui lòng nhập :attribute khi không có :values.',
    'same' => ':other và :attribute không khớp.',
    'size' => [
        'numeric' => ':attribute phải bằng :size.',
        'file' => ':attribute phải bằng :size kilobytes.',
        'string' => ':attribute phải chứa :size ký tự.',
        'array' => ':attribute phải chứa :size phần tử.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng: :values.',
    'string' => ':attribute phải là ký tự.',
    'timezone' => ':attribute phải là múi giờ hợp lệ.',
    'unique' => ':attribute đã tồn tại.',
    'uploaded' => ':attribute tải lên không thành công.',
    'url' => ':attribute không đúng định dạng.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',

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
        'slide' => [
            'name' => 'Tiêu đề hoặc đường dẫn đã tồn tại',
        ],
        'testimony' => [
            'name' => 'Tên đã tồn tại',
        ],
        'category' => [
            'name' => 'Danh mục hoặc đường dẫn đã tồn tại',
        ],
        'post' => [
            'name' => 'Tiêu đề hoặc đường dẫn đã tồn tại',
            'slug' => 'Đường dẫn đã tồn tại',
        ],
        'seo' => [
            'slug' => 'Đường dẫn đã tồn tại',
        ],
        'role' => [
            'name' => 'Vai trò đã tồn tại',
        ],
        'permission' => [
            'name' => 'Quyền đã tồn tại',
        ]
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
        'terms' => 'Điều khoản sử dụng',
        'title' => 'Tiêu đề',
        'slug' => 'Đường dẫn',
        'phone' => 'Số điện thoại',
        'email' => 'Email',
        'current_password' => 'Mật khẩu hiện tại',
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'new_password' => 'Mật khẩu mới',
        'new_password_confirmation' => 'Xác nhận mật khẩu mới',
        'price'=> 'Giá',
        'sale_price' => 'Giá khuyến mãi'
    ],
];
