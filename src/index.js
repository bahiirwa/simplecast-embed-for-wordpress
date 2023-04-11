import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import metadata from './block.json';
import icons from './icons';

registerBlockType( metadata.name, {
	edit: Edit,
    icon: icons.logo,
} );
