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
                <tr style="font-size: 14px; line-height: 25px;">
                    <td>
                        <p class="text-capitalize"
                            style="font-size: 14px; margin-bottom: 0px;"><span class="font-weight-bold"><?= $agenda->perihal; ?></span> <br>
                            <span style="font-size: 12px;">
                                <?= $agenda->nama_bidang; ?> | <?= $agenda->nomor_surat; ?>
                            </span>
                         <!-- list penerima disposisi -->
                        </p>
                         <?= form_open('Surat/pengagendaansurat/' . $agenda->slug_surat); ?>
                        <form style="margin-top: -10px;">
                            <div><button class="btn btn-primary btn-sm btn-custome"
                                    type="submit">Agendakan</button></div>
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