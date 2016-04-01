
function loadSitemap(host_id, parent_id, level) {
    if (jQuery("#sitemap-content-" + host_id + "-" + parent_id).html().length) {
        jQuery("#sitemap-content-" + host_id + "-" + parent_id).html('')
        if (jQuery("#icon" + parent_id).attr('src').indexOf('blank') == -1) {
            jQuery("#icon" + parent_id).attr('src', '/images/plus.png');
        }
    } else {
        jQuery.getJSON('/index/sitemap-level/host_id/' + host_id + '/parent_id/' + parent_id, function (data) {
            if (parent_id && jQuery("#icon" + parent_id).attr('src').indexOf('blank') == -1) {
                jQuery("#icon" + parent_id).attr('src', '/images/minus.png');
            }


            var html = '<table style="width:90%" cellspacing="0" cellpadding="0">'
            //var html = ''
            for (k in data) {
                var img_code = '<img style="margin: 5px;" src="/images/' + (data[k].have_childs ? 'plus' : 'sign-blank') + '.png" align="left" id="icon' + data[k].id + '" onclick="loadSitemap(' + host_id + ', ' + data[k].id + ', ' + (level+1) + ')">'
                //var content_div = '<div style="margin-left: ' + (level*5) + 'px" id="sitemap-content-' + host_id + '-' + data[k].id + '"></div>'
                var content_div = '<div id="sitemap-content-' + host_id + '-' + data[k].id + '"></div>'
                var level_div = '<div id="sitemap-' + host_id + '-' + data[k].id + '" >' +
                    //'<div style="margin-left: ' + (level*5) + 'px" >' +
                    '<div >' +
                    img_code +
                    '<span class="hand" onclick="loadBranchInfo(' + data[k].id + ', ' + host_id + ')" >' + getImageHtmlForBranchItem(data[k]['name']) + data[k]['name'] + '</span>'
                    + '</div>' +
                    content_div +
                    '</div>'
                html += "<tr><td>" + level_div + "<td></tr>"
                //html += level_div
            }
            html += "</table>"
            jQuery("#sitemap-content-" + host_id + "-" + parent_id).html(html)
        })
    }
}

function getImageHtmlForBranchItem(name) {
    if (name.indexOf('.') == -1) {
        var html = '<img src="/images/dir.png" align="left">'
    } else {
        var html = '<img src="/images/file.png" align="left">'
    }
    return html
}

function loadBranchInfo(id, host_id) {
    if (jQuery('#branchInfoDialog')) {
        jQuery('#branchInfoDialog').remove();
    }

    jQuery.getJSON('/index/branch-info/id/' + id + '/host_id/' + host_id + '/', function (data) {
        var html = '<div id="branchInfoDialog" class="ui-dialog" style="overflow:visible" title="Информация о ветке">';
        html += "<b>URL:</b> " + data['url'] + "<br />"
        if (data['params'].length) {
            html += "<b>Параметры:</b> " + data['params'].join(", ") + "<br/>"
        }
        if (data['urls'].length) {
            html += "<b>Links:</b> <br/>"
            for (k in data['urls'])
                html += data['urls'][k].url + "<br />"
        }
        html += "</div>";
        jQuery(html).appendTo('body')
        jQuery( "#branchInfoDialog" ).dialog({
            modal: true,
            width: 800
        });
    })




}