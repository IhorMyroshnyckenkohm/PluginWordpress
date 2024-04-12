jQuery(document).ready(function ()
{
    function displayData( data )
    {
        var container = jQuery( '#ajax-data-container' );

        container.empty();

        container.append( '<p>' + data + '</p>' );
    }

    let crm_url = jQuery( '[name = "CRM_URL"]' );
    jQuery( "#CRM_transfer" ).change( function ()
    {
        jQuery ( "#CRM_URL" ).toggle( jQuery( this ).prop("checked" ) );

        if ( !jQuery ( this ).prop("checked" ) )
        {
            crm_url.val ( '' );
        }
    });

    crm_url.change ( function ()
    {
        jQuery.ajax (
            {
                 url: ajaxurl,
                 type: 'POST',
                 data: {
                    action: 'order_import_ajax_action',
                    CRM_URL: crm_url.val()
                       },
                success : function( data )
                {
                    if ( JSON.parse( data ).valid )
                    {
                        crm_url.next( '.error-message' ).remove();
                        jQuery( "#organization_save" ).prop( "disabled", false );
                    }
                    else
                    {

                    jQuery( '.error-message' ).remove();

                    var errorMessage = '<div class="error-message">URL недійсний</div>';
                    jQuery( "body" ).append( errorMessage );

                    jQuery( "#organization_save" ).prop( "disabled", true );

                    jQuery( ".error-message" ).addClass( "centered-error" );

                    setTimeout (function ()
                    {
                        jQuery( ".error-message" ).fadeOut();
                    }, 1000);

                    jQuery( document ) .mouseup ( function (e)
                    {
                        var container = jQuery ( ".error-message" );
                        if ( !container.is( e.target ) && container.has( e.target ) .length === 0 )
                        {
                            container.fadeOut();
                        }
                    });
                }
            }
        });
    });
});
