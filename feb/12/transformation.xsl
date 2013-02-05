<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:product="http://competec.ch/product"
                xmlns:images="http://competec.ch/images"
                xmlns:fun="my-fun"
                xmlns:exslt="http://exslt.org/common"
                xmlns:func="http://exslt.org/functions"
                extension-element-prefixes="func"
                exclude-result-prefixes="product images fun exslt">

    <xsl:output encoding="UTF-8" indent="yes" method="xml" />

    <func:function name="fun:createPriceImgMapping">
        <xsl:variable name="tmp">
            <mappings>
                <xsl:for-each select="//product:price">
                    <xsl:variable name="position" select="position()" />
                    <mapping>
                        <xsl:attribute name="price">
                            <xsl:value-of select="@value" />
                        </xsl:attribute>
                        <xsl:attribute name="image">

                            <xsl:value-of select="//images:size[$position]/@variant" />
                        </xsl:attribute>
                    </mapping>
                </xsl:for-each>
            </mappings>
        </xsl:variable>
        <func:result select="exslt:node-set($tmp)" />
    </func:function>

    <xsl:template match="/">
    <div>
        <xsl:variable name="mappings" select="fun:createPriceImgMapping()" />
        <xsl:for-each select="$mappings//mapping">
            <span><xsl:value-of select="@price" /> zugeordnet zu <xsl:value-of select="@image" /></span>
        </xsl:for-each>
    </div>
    </xsl:template>

</xsl:stylesheet>