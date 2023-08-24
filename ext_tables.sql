#
# SQL definition of database tables for extension 'ucph_content_quote'
#
--
-- Table structure for table 'tt_content'
--
CREATE TABLE tt_content (
    tx_ucph_content_quote_source varchar(255) DEFAULT '' NOT NULL,
    tx_ucph_content_quote_link varchar(1024) DEFAULT '' NOT NULL,
    tx_ucph_content_quote_alignment varchar(128) DEFAULT '' NOT NULL
);
