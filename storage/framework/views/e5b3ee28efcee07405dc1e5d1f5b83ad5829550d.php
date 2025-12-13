<div>
    <div class="card mb-10">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-row-dashed border-gray-300 align-middle gy-6">
                    <tbody class="fs-6 fw-semibold">
                        <!--begin::Table row-->
                        <tr>
                            <td class="min-w-250px fs-4 fw-bold">Login Alert</td>
                            <td class="w-125px">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" wire:click="save" wire:model="login_alert">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="min-w-250px fs-4 fw-bold">Transaction Notifications</td>
                            <td class="w-125px">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" wire:click="save" wire:model="transaction_notification">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="min-w-250px fs-4 fw-bold">Promotional Emails</td>
                            <td class="w-125px">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" wire:click="save" wire:model="promotional_emails">
                                </div>
                            </td>
                        </tr>
                        <!--begin::Table row-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/settings/notifications.blade.php ENDPATH**/ ?>