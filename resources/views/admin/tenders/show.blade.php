<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Tender Details') }}</h2>
        <a href="{{ route('admin_tenders_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <!-- Tender details -->
    <dl class="row">
        <!-- Ваши поля тендера -->
    </dl>

    <h3>{{ __('Tender Proposals') }}</h3>
    <a href="{{ route('admin_tender_proposals_create', ['tenderId' => $tender->id]) }}" class="btn btn-primary">{{ __('Add New Tender Proposal') }}</a>

    <table class="table table-striped table-hover mt-4">
        <thead>
            <tr>
                <th>{{ __('Company Name') }}</th>
                <th>{{ __('Legal Address') }}</th>
                <th>{{ __('Contact Person Name') }}</th>
                <th>{{ __('Contact Person Phone') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tender->proposals as $proposal)
                <tr>
                    <td>{{ $proposal->company_name }}</td>
                    <td>{{ $proposal->legal_address }}</td>
                    <td>{{ $proposal->contact_person_name }}</td>
                    <td>{{ $proposal->contact_person_phone }}</td>
                    <td>
                        <a href="{{ route('admin_tender_proposals_edit', ['id' => $proposal->id]) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                        <form action="{{ route('admin_tender_proposals_destroy', ['id' => $proposal->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this tender proposal?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('No tender proposals found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
