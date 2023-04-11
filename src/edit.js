import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextareaControl, ToggleControl } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';

export default function Edit( { attributes, setAttributes } ) {
    const { link, isDark } = attributes;

    let [apiQuery, setApiQuery] = useState(null);
    const [ hasDarkMode, setDarkMode ] = useState( false );

    useEffect(() => {
        fetch(`https://api.simplecast.com/oembed?url=${link}`)
        .then(response => response.json())
        .then(data => setApiQuery(getIframeSrc(data.html)))
    },[link])

    function getIframeSrc(html) {
        const div = document.createElement('div');
        div.innerHTML = html;
        const iframe = div.querySelector('iframe');
        return iframe.src;
    }

    if ( null !== apiQuery || '' !== apiQuery ) {
        let linked = `${apiQuery}?dark=${hasDarkMode}`;

        return (
            <div {...useBlockProps() }>
                <iframe height="200px" width="100%" frameborder="no" seamless src={linked}></iframe>
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
                            help={ hasDarkMode ? 'Enable Dark Mode.' : 'Disable Dark Mode.' }
                            checked={ hasDarkMode }
                            onChange={ () => { setDarkMode( ( state ) => ! state ); } }
                        />
                    </PanelBody>
                </InspectorControls>
            </div>
        );
    }

}
