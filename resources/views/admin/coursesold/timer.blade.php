@extends('layouts.app')

@section('content')
<div id="countdown-timer"></div>


<script>
    if ($module->status === 'publish' && $module->published_at){
        const endTime = new Date("{{ $module->published_at->addHours(6) }}");
        initializeCountdown(endTime, 'countdown-timer');
    }

</script>

@endsection