<form id="organization_form" method="post" action="#">

    <label for="organization_name"> Organization name

        <input value="<?php echo get_option('organization_name') ?>"
               type="text"
               id="organization_name"
               name="organization_name"/>
        <br>

    </label>
    <label for="CRM_transfer"> CRM transfer
        <input <?php echo (strlen(get_option('CRM_transfer')) > 0)? 'checked' : '' ?>
                type="checkbox"
                id="CRM_transfer"
                name="CRM_transfer"/>
        <br>

    </label>
    <label
            for="CRM_URL"
            id="CRM_URL"
        <?php echo empty(get_option('CRM_transfer')) ? 'hidden' : '' ?>> CRM URL

        <input
                value="<?php echo get_option('CRM_URL') ?>"
                type="text"
                name="CRM_URL"
        />

        <br>
    </label>

    <button id="organization_save" type="submit"> Submit </button>

</form>
