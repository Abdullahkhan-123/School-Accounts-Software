<!-- Start Quick Payment  -->

@foreach($PaymentRecords as $Records)
<!-- Start Fee received some details -->
<div class="modal fade" id="modal{{ $Records->UniqueCode }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fee Received Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('StudentQuickPayment', $Records->UniqueCode) }}">
                    @csrf
                    <div class="col">
                        <label>Fee Received Method:</label>
                        <select class="form-control" name="FeeMethod" id="FeeMethod{{ $Records->UniqueCode }}" required>
                            <option value="" selected disabled>Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Online">Online</option>                                    
                        </select>
                    </div>

                    <div class="col" id="BankAccountDiv{{ $Records->UniqueCode }}" style="display:none;">
                        <label>Bank Account:</label>
                        <select class="form-control" name="BankAccount" id="BankAccount{{ $Records->UniqueCode }}">
                            <option value="" selected disabled>Select</option>
                            @foreach($BankAccount as $Account)
                                <option value="{{ $Account->id }}">{{ $Account->BankName. ' - ' .$Account->AccountType }}</option>
                            @endforeach                                   
                        </select>
                    </div>

                    <div class="col-12 mt-2 d-flex justify-content-end align-items-end">                                        
                        <button type="submit" class="btn btn-primary mb-2 ml-2">Save</button>
                    </div>
                </form>
            </div>                    
        </div>
    </div>
</div>
<!-- End Fee received some details -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var feeMethodSelect = document.getElementById('FeeMethod{{ $Records->UniqueCode }}');
        var bankAccountDiv = document.getElementById('BankAccountDiv{{ $Records->UniqueCode }}');
        var bankAccountSelect = document.getElementById('BankAccount{{ $Records->UniqueCode }}');

        feeMethodSelect.addEventListener('change', function () {
            if (this.value === 'Online') {
                bankAccountDiv.style.display = 'block';
                bankAccountSelect.required = true;
            } else {
                bankAccountDiv.style.display = 'none';
                bankAccountSelect.required = false;
            }
        });
    });
</script>

@endforeach




<!-- Start Partial Payment  -->
@foreach($PaymentRecords as $Records)
<!-- Start Partial Payment Modal -->
<div class="modal fade" id="PartialModal{{ $Records->UniqueCode }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Partial Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('StudentPartialPayment', $Records->UniqueCode) }}">
                    @csrf
                    <div class="col">
                        <label>Fee Received Method:</label>
                        <select class="form-control" name="FeeMethod" id="PartialFeeMethod{{ $Records->UniqueCode }}" required>
                            <option value="" selected disabled>Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>

                    <div class="col">
                        <label>Balance Amount:</label>
                        <input type="text" class="form-control" name="PartialAmount" placeholder="Balance Amount" value="{{ $Records->Balance }}" readonly>
                    </div>

                    <div class="col">
                        <label>Partial Amount:</label>
                        <input type="text" class="form-control" name="PartialAmount" placeholder="Partial Amount">
                    </div>

                    <div class="col" id="PartialBankAccountDiv{{ $Records->UniqueCode }}" style="display:none;">
                        <label>Bank Account:</label>
                        <select class="form-control" name="BankAccount" id="PartialBankAccount{{ $Records->UniqueCode }}">
                            <option value="" selected disabled>Select</option>
                            @foreach($BankAccount as $Account)
                                <option value="{{ $Account->id }}">{{ $Account->BankName. ' - ' .$Account->AccountType }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-2 d-flex justify-content-end align-items-end">
                        <button type="submit" class="btn btn-primary mb-2 ml-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Partial Payment Modal -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var partialFeeMethodSelect = document.getElementById('PartialFeeMethod{{ $Records->UniqueCode }}');
        var partialBankAccountDiv = document.getElementById('PartialBankAccountDiv{{ $Records->UniqueCode }}');
        var partialBankAccountSelect = document.getElementById('PartialBankAccount{{ $Records->UniqueCode }}');

        partialFeeMethodSelect.addEventListener('change', function () {
            if (this.value === 'Online') {
                partialBankAccountDiv.style.display = 'block';
                partialBankAccountSelect.required = true;
            } else {
                partialBankAccountDiv.style.display = 'none';
                partialBankAccountSelect.required = false;
            }
        });
    });
</script>
@endforeach