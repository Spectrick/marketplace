
@extends('layouts.main')

@section('page.title', 'Корзина')

@section('main.content')
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">{{ __('Товар') }}</th>
                <th style="width:10%">{{ __('Цена') }}</th>
                <th style="width:8%">{{ __('Количество') }}</th>
                <th style="width:22%" class="text-center">{{ __('Всего') }}</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php
                    $total += $details['price'] * $details['quantity']
                @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{ $details['image'] }}" width="100" class="img-responsive" />
                            </div>
                            <div class="col-sm-9">
                                <a href="{{ (isAdmin(Auth::user()) ? route('admin.products.show', $id) : route('products.show', $id)) }}">
                                    <h5 class="nomargin pt-2">{{ $details['name'] }}</h5>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price" class="pt-3">
                        {{ $details['price'] }} {{ session('currency') }}
                    </td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center pt-3">
                        {{ $details['price'] * $details['quantity'] }} {{ session('currency') }}
                    </td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart mt-1">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    <h3><strong>{{ __('Всего к оплате') }} {{ $total }} {{ session('currency') }}</strong></h3>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">
                    <a href="{{ (isAdmin(Auth::user()) ? route('admin.products') : route('products')) }}" class="btn btn-primary">
                        <i class="fa fa-angle-left"></i> {{ __('Продолжить покупки') }}
                    </a>
                    <button class="btn btn-success">
                        {{ __('Оформить заказ') }}
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>
@endsection

@once
    @push('js')
        <script type="text/javascript">

            $(".update-cart").change(function (e) {
                e.preventDefault();

                var ele = $(this);

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: "put",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val()
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });

            $(".remove-from-cart").click(function (e) {
                e.preventDefault();

                var ele = $(this);

                if(confirm("Вы действительно хотите удалить товар из корзины?")) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
        </script>
    @endpush
@endonce
