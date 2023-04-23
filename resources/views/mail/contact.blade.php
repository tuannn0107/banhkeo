@component('mail::message')

@component('mail::table')
|                                                  |                       |
| ------------------------------------------------ | ----------------------|
@isset($contact->name)|    @lang('Name')           | {{$contact->name}}    |
@endisset
@isset($contact->phone)|   @lang('Phone number')   | {{$contact->phone}}   |
@endisset
@isset($contact->email)|   @lang('E-Mail Address') | {{$contact->email}}   |
@endisset
@isset($contact->address)| @lang('Address')        | {{$contact->address}} |
@endisset
@isset($contact->content)| @lang('Content')        | {{$contact->content}} |
@endisset
@endcomponent

@endcomponent
