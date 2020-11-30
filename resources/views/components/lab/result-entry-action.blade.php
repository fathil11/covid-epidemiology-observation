@if ($test->result != null)
<a class="btn btn-secondary btn-pill" href="{{ route('lab.pe.action.retire', ['code' => $test->code]) }}">Cabut Hasil</a>
    @if($test->result->value == 'positif')
    <a class="btn btn-primary btn-pill" href="{{ route('lab.pe.action.negative', ['code' => $test->code]) }}">Negatif</a>
    @else
    <a class="btn btn-danger btn-pill" href="{{ route('lab.pe.action.positive', ['code' => $test->code]) }}">Positif</a>
    @endif
@else
<a class="btn btn-danger btn-pill" href="{{ route('lab.pe.action.positive', ['code' => $test->code]) }}">Positif</a>
<a class="btn btn-primary btn-pill" href="{{ route('lab.pe.action.negative', ['code' => $test->code]) }}">Negatif</a>
@endif
