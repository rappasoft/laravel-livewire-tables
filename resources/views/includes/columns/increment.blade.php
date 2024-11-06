@aware(['rowIndex'])
<div {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}>{{ $rowIndex+1 }}</div>
