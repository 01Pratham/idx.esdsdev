<table class="tbl_tc  except" style="max-width: 2058px; margin: auto;">
     <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
    <tbody hidden>
        
        <tr>
            <th style="background: rgba(198,224,180,1)">Service Components</th>
            <th style="background: rgba(198,224,180,1)">Monthly Service Pay</th>
            <th style="background: rgba(198,224,180,1)">Months</th>
            <th style="background: rgba(198,224,180,1)">Total Cost</th>
            <th style="background: rgba(198,224,180,1)">One Time Service Pay</th>
        </tr>
        <?php
        for ($i = 1; $i <= count($estmtname); $i++) {
        ?>
            <tr>
                <td>ESDS' eNlight Cloud Hosting Services - <?= $estmtname[$i] ?></td>
                <td><?= INR(array_sum($total[$i])); ?></td>
                <td><?= intval($period[$i]) ?></td>
                <td><?= INR(array_sum($total[$i]) * intval($period[$i])); ?></td>
                <td><?= INR((array_sum($total[$i]) * 12) * 0.05); ?></td>
            </tr>

        <?php
            $FinalTotal[] = array_sum($total[$i]) * intval($period[$i]);
            $FinalOTC[] = (array_sum($total[$i]) * 12) * 0.05;
        }

        ?>
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td><?= INR(array_sum($FinalTotal)); ?></td>
            <td><?= INR(array_sum($FinalOTC)); ?></td>
        </tr>
        <tr>
            <th style="background: rgba(198,224,180,1)" colspan=4>Total Cost for <?= implode(" and ", $estmtname); ?> ( Exclusive of Taxes ).</th>
            <th style="background: rgba(198,224,180,1)"><?= INR(array_sum($FinalTotal) + array_sum($FinalOTC)) ?></th>
        </tr>
    </tbody>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;"> </tr>
    <tr style="background: white; border: hidden;"> </tr>
    <tr style="background: white; border: hidden;"> </tr>

    <tbody id="TClines">
        <tr>
            <th class="noBorder" colspan=80 style="color : rgba(0, 182, 255,1)">Terms and Conditions</th>
        </tr>
        <tr style=" border: hidden;">
            <td style="background:white" hidden class= "noBorder"></td>
            <td contentEditable="true" colspan=80 class="myTextArea noBorder noExl" id="terms_cond">
                All prices are in Indian Rupee without Taxes.<br>
                Any change in the taxes, duties or levies due to change in government policies will be borne by the customer.<br>
                Billing shall start from the date of infrastructure hand-over in partial or full, irrespective of the Go-Live of the project, for e.g Dev environment is setup and released to client/partner for development activity, then the billing for the Dev environment will start immediately after Development environment is handed over to department / partner, similarly for any other environment, what ever is handed over, billing will start immediately after that.<br>
                The quote is valid for 15 days from the date of submission of offer.<br>
                Above best prices are for the minimum commitment of 60 months.<br>
                Infrastructure setup will be done based on the finalized and approved BoM and architecture, in case any change need to be done, then it will be considered as a change request and charges for the same will be additional.<br>
                Prices are composite for the total Bill of Material and may vary with change in the Bill of Material due to increase or decrease in quantity/service period at the time of ordering<br>
                Software which are proposed in the BoM with default features, if any specific features is required then the charges for the same would be extra.<br>
                Software which are proposed in the BoM with default features, if any specific features is required then the charges for the same would be extra.<br>
                Any changes to the proposed solution, architecture, bill of material, scope of work after PO issuance and sign-off on all these points will be considered as additional requirement and will be considered as change request and shall be processed only if applicable charges are accepted and written acceptance is submitted.<br>
                In case the client requires any new or additional item/service/license except what is mentioned in the proposal, will be charged at additional prices. Rates/Prices & Scope for all such additional/new requirements over and above the BoM/BoQ/Proposal submitted at the time of finalization will be additional and such Rates/Prices & Scope will be submitted to the client based on the actual requirement.<br>
                For any such additional item or service required over and above the BoM/BoQ/Proposal submitted at the time of finalization, the client will have to either raise PO or Confirm over email with acceptance to the new requirement and its applicable charges submitted by ESDS post receiving the additional requirement.<br>
                Payment to all such new requirements to be done by the client along with other ongoing invoices. Billing for any such additional requirement will be included either in the upcoming invoices from ESDS or for any item or service if any advance payment is required, then client will have to make the advance payment along with PO or email confirmation for any kind of additional item or service or anything that is required from ESDS as part of the service. <br>
                ESDS will provision the items/services/devices based on the available make & model of that particular item at the time of delivery. The client will not stop project Go-Live or Project acceptance or Payments for asking items/products/services of different make & model besides what ESDS has provisioned.<br>
                In case of any disputes at the time of PO acceptance or during the contract period related to any requirement not covered in the proposal / BoM / BoQ submitted by ESDS, both parties that is Client & ESDS will mutually discuss and check the requirement and come to conclusion to proceed further & how, further to this, in case there is dispute due to any such additional/new/change requirement for which there’s commercial impact, the client should not hold the project implementation/completion and payments to ESDS.<br>
                Anything that is not mentioned in the proposal/commercial/BoQ/BoM submitted by ESDS at the time of finalization of PO, will not be delivered for whatsoever reason.<br>
                PO to be issued along with sign-off from customer on the scope of work, SLA, RACI matrix, terms & conditions mentioned in the proposal submitted by ESDS.<br>
                The Unit rates mentioned for different phases/years are subject to the usage of the overall capacity planned for that particular phase/year, if the resource utilization is not till the capacity planned for that particular phase/year, then the 1st year’s rates would be applicable and not that specific years/phase unit rates.
            </td>
        </tr>
    </tbody>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tbody id="AClines">
        <tr>
            <th class="noBorder" colspan=80 style="color : rgba(0, 182, 255,1)">ESDS's Assumptions and Considerations</th>
        </tr>
        <tr>
            <td colspan=80 contentEditable="true" class="myTextArea noBorder assump noExl" id="asump">
                Enter your Assumptions.
            </td>
        </tr>
    </tbody>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tbody id="EXlines">
        <tr>
            <th class="noBorder" colspan=80 style="color : rgba(0, 182, 255,1)">ESDS's Exclusions</th>
        </tr>
        <tr>
            <td colspan="80" contentEditable="true" id="text_excl" class="myTextArea noBorder assump noExl">
                Enter your Exclusions.
            </td>
        </tr>
    </tbody>


</table>




<script>
    function inputLines(textArea, lineID) {
        let text = $(textArea).html()
        let lines = text.split('<br>');

        lines.forEach(function(line) {
            line = line.replace("\n                ", '');
            $(lineID).append("<tr hidden class = 'line '><td class = 'noBorder' > " + line + " </td></tr>")
        });
        $(textArea).on({
            "keypress": function(event) {
                if (event.keyCode === 13) {
                    $(this).append("<br>")
                }
            },
            "blur": function() {
                // console.log('h')
                text = $(textArea).html();
                lines = text.split('<br>');

                $("#TClines .line").remove();
                lines.forEach(function(line) {
                    $(lineID).append("<tr hidden class = 'line '><td class = 'noBorder' > " + line + " </td></tr>")
                })
            }

        })
    }

    inputLines("#terms_cond", '#TClines');
    inputLines("#asump", '#AClines');
    inputLines("#text_excl", '#EXlines');
</script>