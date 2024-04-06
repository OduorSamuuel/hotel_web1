@include('admin.layout')
@include('reports.bookingreport')
<div class="page-wrapper" style="min-height: 100vh; overflow-y: auto;">
<a id="downloadButton" href="{{ route('bookings') }}" download="user_report.pdf">Download Report</a>
</div>

    @include('admin.endlayout')