/**
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

import React, { RefObject, useEffect, useRef } from "react";
import { IBaseEmbedProps } from "@library/embeddedContent/embedService";
import { EmbedContainer } from "@library/embeddedContent/EmbedContainer";
import { EmbedContent } from "@library/embeddedContent/EmbedContent";
import { IImageMeta, ImageEmbedMenu } from "@library/embeddedContent/menus/ImageEmbedMenu";

interface IProps extends IBaseEmbedProps {
    type: string; // Mime type.
    size: number;
    dateInserted: string;
    name: string;
    width?: number;
    height?: number;
    saveImageMeta?: () => IImageMeta;
    hasFocus: boolean;
}

/**
 * An embed class for quoted user content on the same site.
 */
export function ImageEmbed(props: IProps) {
    const { inEditor, type, size, dateInserted, name, width, height, saveImageMeta } = props;
    const extraProps: any = {};

    useEffect(() => {
        extraProps.imageEmbedRef = useRef();
    }, [inEditor]);

    return (
        <EmbedContent type="Image" inEditor={props.inEditor} {...extraProps}>
            <div className="embedImage-link u-excludeFromPointerEvents">
                <img className="embedImage-img" src={props.url} alt={props.name} />
                {props.inEditor && (
                    <ImageEmbedMenu
                        saveImageMeta={props.saveImageMeta}
                        elementToFocusOnClose={extraProps.imageEmbedRef}
                    />
                )}
            </div>
        </EmbedContent>
    );
}
