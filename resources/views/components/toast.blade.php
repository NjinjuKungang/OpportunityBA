@if (session()->has('message'))
    <div 
    x-data="{show: false}"
    x-init="setTimeout(() => show = false, 2000)"
    x-show='show'
    class="absolute top-[11%] left-[40%] bg-violet-500 text-white z-40 rounded-md mx-auto p-4"
    >
    <p>{{session('message')}}</p>
    </div>
@endif