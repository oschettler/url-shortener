<links>

    <table class="u-full-width">
        <thead>
            <tr><th>Key</th><th colspan="2">Target</th></tr>
        </thead>
        <tbody>
            <tr each={ opts.links }>
                <td class="key" contenteditable="true">{ key }</td>
                <td class="target" contenteditable="true">{ target }</td>
                <td><a href="/api/{ key }" onclick={ parent.save }>update</a></td>
            </tr>
            <tr>
                <td class="key" contenteditable="true">new key</td>
                <td class="target" contenteditable="true">new target</td>
                <td><a href="/api" onclick={ create }>create</a></td>
            </tr>
        </tbody>
    </table>

    save(e) {

        console.log('Save');
        var href = $(e.target).attr('href'),
            key = $(e.target).parents('td').siblings('.key').html(),
            target = $(e.target).parents('td').siblings('.target').html();

        api(href, {
            method: "PUT",
            data: {
                key: key,
                target: target
            },
            success: function () {
                console.log("Saved");
            }
        });
    }

    create(e) {
        console.log('Create');

        var href = $(e.target).attr('href'),
            key = $(e.target).parents('td').siblings('.key').html(),
            target = $(e.target).parents('td').siblings('.target').html();

        api(href, {
            method: "POST",
            data: {
                key: key,
                target: target
            },
            success: function () {
                console.log("Created");
                location.reload();
            }
        });
    }

</links>