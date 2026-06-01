CREATE DATABASE IF NOT EXISTS store;
USE store;

CREATE TABLE productos (
  producto_id      INTEGER      NOT NULL  AUTO_INCREMENT,
  nombre           VARCHAR(255) NOT NULL,
  sku              VARCHAR(25)  NOT NULL  UNIQUE,
  categoria        VARCHAR(50)  NOT NULL,
  precio           DECIMAL(10,2)NOT NULL,
  descripcion      VARCHAR(255) NOT NULL,
  codigo_de_barras VARCHAR(255) NOT NULL,
  stock            INT          NOT NULL  DEFAULT 0,
  stock_min        INT          NOT NULL  DEFAULT 5  COMMENT 'Low-stock alert threshold',
  activo           TINYINT(1)       NULL             COMMENT 'NULL = active, 1 = deactivated',
  create_time      TIMESTAMP    NOT NULL  DEFAULT CURRENT_TIMESTAMP(),
  update_time      TIMESTAMP    NOT NULL  DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (producto_id),
  INDEX idx_categoria (categoria),
  INDEX idx_activo    (activo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO productos (nombre, sku, categoria, precio, descripcion, codigo_de_barras, stock, stock_min) VALUES
('Black Shirt Medium',      'blk-shirt-m',  'Clothing',    25.00,   'Black shirt, size medium',            '9876453210',  50, 10),
('Blue Pants Medium',       'ble-pants-m',  'Clothing',    75.00,   'Blue pants, size medium',             '159374826',   30,  5),
('Laptop Core i5',          'gry-laptop-c', 'Electronics', 1000.00, 'Laptop gray, Intel Core i5',          '321456789',    3,  5),
('MacBook Pro M1',          'gry-macbook-k','Electronics', 1250.00, 'MacBook Pro M1, 256 GB SSD, 8 GB RAM','682475319',    2,  5),
('iPhone 12 128 GB',        'ble-iphone-e', 'Electronics',  799.00, 'iPhone 12, 128 GB storage',           '456912387',    8,  5),
('Brown Couch',             'brw-couch-b',  'Furniture',   650.00, 'Large brown couch',                   '284615973',    4,  5);
