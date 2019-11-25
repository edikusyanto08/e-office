<div class="tab-content bg-white mb-3 shadow" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="tab-pane fade show active" id="suratmasuk" role="tabpanel" aria-labelledby="pills-table-content-tab">
        <div class="border-bottom">
            <p>
                <h5 class="font-weight-bold ml-3">Pengagendaan Surat</h5>
            </p>
        </div>
        <table class="table table-borderless">
            <?php if ($agenda_surat != null) { ?>
            <tbody>
                <?php $i = 0;
                        foreach ($agenda_surat as $agenda) { ?>
                <tr style="font-size: 12px;">
                    <td>
                        <span class="font-weight-bold text-capitalize"
                            style="font-size: 14px;"><?= $agenda->perihal; ?></span> <br>
                        <?= $agenda->nama; ?> | <?= $agenda->nomor_surat; ?>
                        <!-- list penerima disposisi -->
                    </td>
                    <td>
                        <?= form_open('Surat/pengagendaansurat/' . $agenda->slug_surat); ?>
                        <form>
                            <p class="text-right"><button class="btn btn-primary btn-sm btn-custome"
                                    type="submit">Agendakan</button></p>
                        </form>
                        <?= form_close(); ?>
                    </td>
                </tr>
                <?php
                            $i++;
                        } ?>
            </tbody>
            <?php } else { ?>
            <div class="mt-4 text-center text-capitalize">
                data tidak ditemukan
            </div>
            <?php } ?>
        </table>
    </div>
</div>