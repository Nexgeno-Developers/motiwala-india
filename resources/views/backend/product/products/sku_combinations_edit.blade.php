@if(count($combinations) > 0)
<table class="table table-bordered aiz-table">
    <thead>
        <tr>
            <td class="text-center">
                {{translate('Variant')}}
            </td>
            <td class="text-center">{{translate('Gold Section')}}</td>
            <td class="text-center">{{translate('Diamond Section')}}</td>
            <td class="text-center">
                {{translate('Variant Price')}}
            </td>
            <td class="text-center" data-breakpoints="lg">
                {{translate('SKU')}}
            </td>
            <td class="text-center" data-breakpoints="lg">
                {{translate('Quantity')}}
            </td>
            <td class="text-center" data-breakpoints="lg">
                {{translate('Photo')}}
            </td>
        </tr>
    </thead>
    <tbody>

        @foreach ($combinations as $key => $combination)
            @php
                $variation_available = false;
                $sku = '';
                foreach (explode(' ', $product_name) as $key => $value) {
                    $sku .= substr($value, 0, 1);
                }

                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ) {
                        $str .= '-'.str_replace(' ', '', $item);
                        $sku .='-'.str_replace(' ', '', $item);
                    }
                    else {
                        if($colors_active == 1) {
                            $color_name = \App\Models\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                            $sku .='-'.$color_name;
                        }
                        else {
                            $str .= str_replace(' ', '', $item);
                            $sku .='-'.str_replace(' ', '', $item);
                        }
                    }
                    $stock = $product->stocks->where('variant', $str)->first();
                    // if($stock != null) {
                    //     $variation_available = true;
                    // }
                }
            @endphp
            @if(strlen($str) > 0)
            <tr class="variant">
                <td>
                    <label for="" class="control-label">{{ $str }}</label>
                </td>
                <td>
                    <select name="gold_carat_{{ $str }}" class="form-control gold-carat">
                        @if($stock != null)
                            <option value="gold_rate_18_carat" @if($stock->gold_carat == 'gold_rate_18_carat') selected @endif>18 Carat</option>
                            <option value="gold_rate_21_carat" @if($stock->gold_carat == 'gold_rate_21_carat') selected @endif>21 Carat</option>
                        @elseif($product != null)
                            <option value="gold_rate_18_carat" @if($product->gold_carat == 'gold_rate_18_carat') selected @endif>18 Carat p</option>
                            <option value="gold_rate_21_carat" @if($product->gold_carat == 'gold_rate_21_carat') selected @endif>21 Carat p</option>
                        @else
                            <option value="gold_rate_18_carat">18 Carat</option>
                            <option value="gold_rate_21_carat">21 Carat</option>
                        @endif
                    </select>

                    <input name="gold_qty_{{ $str }}" type="number" class="form-control gold-qty mt-2" value="@php
                            if($stock != null){
                                echo $stock->gold_qty;
                            }
                            else{
                                echo $product->gold_qty;
                            }
                        @endphp" placeholder="Gold Quantity (grams)" min="0" step="0.01">

                    <input name="gold_rate_{{ $str }}" type="number" value="@php
                            if($stock != null){
                                echo $stock->gold_rate;
                            }
                            else{
                                echo $product->gold_rate;
                            }
                        @endphp" min="0" step="0.01" class="form-control gold-rate mt-2" readonly>
                    <p class="gold-preview mt-2 text-muted">Gold Calculation: 0.00 x 0.00 = 0.00</p>
                </td>
                <td>
                    <select name="diamond_carat_{{ $str }}" class="form-control diamond-carat">
                        @if($stock != null)
                            <option value="diamond_rate_14_carat" @if($stock->diamond_carat == 'diamond_rate_14_carat') selected @endif>14 Carat</option>
                            <option value="diamond_rate_18_carat" @if($stock->diamond_carat == 'diamond_rate_18_carat') selected @endif>18 Carat</option>
                        @elseif($product != null)
                            <option value="diamond_rate_14_carat" @if($product->diamond_carat == 'diamond_rate_14_carat') selected @endif>14 Carat p</option>
                            <option value="diamond_rate_18_carat" @if($product->diamond_carat == 'diamond_rate_18_carat') selected @endif>18 Carat p</option>
                        @else
                            <option value="diamond_rate_14_carat">14 Carat</option>
                            <option value="diamond_rate_18_carat">18 Carat</option>
                        @endif
                    </select>


                    <input name="diamond_qty_{{ $str }}" value="@php
                            if($stock != null){
                                echo $stock->diamond_qty;
                            }
                            else{
                                echo $product->diamond_qty;
                            }
                        @endphp" type="number" class="form-control diamond-qty mt-2" placeholder="Diamond Quantity (grams)" min="0" step="0.01">

                    <input name="diamond_rate_{{ $str }}" type="number" value="@php
                            if($stock != null){
                                echo $stock->diamond_rate;
                            }
                            else{
                                echo $product->diamond_rate;
                            }
                        @endphp" min="0" step="0.01" class="form-control diamond-rate mt-2" readonly>
                    <p class="diamond-preview mt-2 text-muted">Diamond Calculation: 0.00 x 0.00 = 0.00</p>
                </td>
                <td>
                    <input readonly class="form-control varient-price" type="number" lang="en" name="price_{{ $str }}" value="@php
                            if ($product->unit_price == $unit_price) {
                                if($stock != null){
                                    echo $stock->price;
                                }
                                else {
                                    echo $unit_price;
                                }
                            }
                            else{
                                echo $unit_price;
                            }
                           @endphp" min="0" step="0.01" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="sku_{{ $str }}" value="@php
                            if($stock != null) {
                                echo $stock->sku;
                            }
                            else {
                                echo $str;
                            }
                           @endphp" class="form-control">
                </td>
                <td>
                    <input type="number" lang="en" name="qty_{{ $str }}" value="@php
                            if($stock != null){
                                echo $stock->qty;
                            }
                            else{
                                echo '10';
                            }
                           @endphp" min="0" step="1" class="form-control" required>
                </td>
                <td>
                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                        </div>
                        <div class="form-control file-amount text-truncate">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="img_{{ $str }}" class="selected-files" value="@php
                                if($stock != null){
                                    echo $stock->image;
                                }
                                else{
                                    echo null;
                                }
                               @endphp">
                    </div>
                    <div class="file-preview box sm"></div>
                </td>
            </tr>
            @endif
        @endforeach

    </tbody>
</table>
@endif
