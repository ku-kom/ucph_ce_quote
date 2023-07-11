#
# SQL definition of database tables for extension 'ucph_ce_quote'
#
--
-- Table structure for table 'tt_content'
--
CREATE TABLE tt_content (
    quote_source varchar(255) DEFAULT '' NOT NULL,
    quote_link varchar(1024) DEFAULT '' NOT NULL,
);
