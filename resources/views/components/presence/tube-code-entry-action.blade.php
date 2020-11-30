@if ($test_at == null)
<form action="{{ route('pe.presence', $code) }}" method="POST" autocomplete="off">
    @csrf
    @method('post')
    <div class="row">
        <div class="col-7">
            <input type="text" class="form-control @error("tube_code") is-invalid @enderror" name="tube_code" placeholder="Nomor tabung" value="MW-" required>
        </div>
        <div class="col-5">
            <button type="submit" class="btn btn-success">Absen</button>
        </div>
    </div>
</form>
@else
<a href="{{ route('pe.presence.delete', $code) }}" class="btn btn-warning">Tarik Absen</a>
@endif
