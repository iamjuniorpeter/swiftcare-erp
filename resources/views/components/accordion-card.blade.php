@props(['params'])
<div class="card">
    <div class="card-header" id="headingOne1{{$params['cardId']}}">
    <section class="mb-0 mt-0">
        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne{{$params['cardId']}}" aria-expanded="true" aria-controls="defaultAccordionOne{{$params['cardId']}}">
            {{$params['label']}}  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
        </div>
    </section>
    </div>

    <div id="defaultAccordionOne{{$params['cardId']}}" class="collapse" aria-labelledby="headingOne1{{$params['cardId']}}" data-parent="#toggleAccordion{{$params['toggleId']}}">
    <div class="card-body">
        {{ $slot }}
    </div>
    </div>
</div>