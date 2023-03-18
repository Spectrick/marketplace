@props(['product_rating'])

<div {{ $attributes->class(['row']) }}>
    <div class="col-xs-12 col-md-8">
        <div class="bg-light p-3 rounded shadow">
            <div class="row">
                <div class="col-xs-12 col-md-4 text-center">
                    <h1 class="rating-num">
                        {{ $product_rating['avg'] }}
                    </h1>
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($product_rating['avg'] < $i)
                                <i class="text-warning fa fa-star-o"></i>
                            @else
                                <i class="text-warning fa fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <div>
                        <i class="fa fa-user" aria-hidden="true"></i> {{ $product_rating['total'] }} {{ __('отзывов') }}
                    </div>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="row rating-desc">
                        @for($i = 5; $i >= 1; $i--)
                            <div class="col-xs-3 col-md-5 text-end">
                                @for($j = $i; $j >= 1; $j--)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <div class="col-xs-8 col-md-7 mt-1">
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{ ($product_rating[$i]['percentage'] ?? 0) }}"
                                     aria-valuemin="0" aria-valuemax="100">
                                    @switch($i)
                                        @case(5)
                                            <div class="progress-bar progress-bar-striped bg-success" style="width: {{ ($product_rating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($product_rating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                            @break
                                        @case(4)
                                            <div class="progress-bar bg-success" style="width: {{ ($product_rating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($product_rating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                            @break
                                        @case(3)
                                            <div class="progress-bar bg-info" style="width: {{ ($product_rating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($product_rating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                        @break
                                        @case(2)
                                            <div class="progress-bar bg-warning" style="width: {{ ($product_rating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($product_rating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                        @break
                                        @case(1)
                                            <div class="progress-bar bg-danger" style="width: {{ ($product_rating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($product_rating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
