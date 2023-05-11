import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextareaControl, ToggleControl } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';

export default function Edit( { attributes, setAttributes } ) {
    const { link, isDark } = attributes;
    let [apiQuery, setApiQuery] = useState(null);

    useEffect(() => {
        fetch(`https://api.simplecast.com/oembed?url=${link}?dark=${isDark}`)
        .then(response => response.json())
        .then(data => setApiQuery(getIframeSrc(data.html)))
    },[link,isDark])

    function getIframeSrc(html) {
        const div = document.createElement('div');
        div.innerHTML = html;
        const iframe = div.querySelector('iframe');
        return iframe.src;
    }

    if ( null !== apiQuery || '' !== apiQuery ) {
        let linked = `${apiQuery}`;

        return (
            <div {...useBlockProps() }>
                <iframe height="200px" width="100%" frameborder="no" scrolling="no" seamless src={linked}></iframe>
                <InspectorControls>
                    <PanelBody title={__('Podcast Settings', 'simplecast-embed-for-wordpress')} initialOpen={true}>
                        <TextareaControl
                            label={__('Podcast Link', 'simplecast-embed-for-wordpress')}
                            placeholder='https://link.domain'
                            type="url"
                            value={link}
                            onChange={(link) => setAttributes({ link }) }
                        />
                    </PanelBody>
                    <PanelBody title={__('Presentation Settings', 'simplecast-embed-for-wordpress')} initialOpen={false}>
                        <ToggleControl
                            label="Enable Dark Mode"
                            help={ isDark ? 'Enable Dark Mode.' : 'Disable Dark Mode.' }
                            checked={ isDark }
                            onChange={ (isDark) => { setAttributes( { isDark } ); } }
                        />
                    </PanelBody>
                </InspectorControls>
            </div>
        );
    }

}
