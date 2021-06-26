CREATE DATABASE store;

CREATE TABLE productos(
  producto_id           INTEGER          NOT NULL  AUTO_INCREMENT,
  nombre                VARCHAR(255)     NOT NULL,
  sku                   VARCHAR(25)     NOT NULL,
  categoria             VARCHAR(50)     NOT NULL,
  precio                FLOAT            NOT NULL,
  descripcion           VARCHAR(255)     NOT NULL,
  codigo_de_barras      VARCHAR(255)     NOT NULL,
  activo                VARCHAR(1)           NULL   COMMENT 'Null es activo y 1 es desactivado.',
  create_time           TIMESTAMP        NOT NULL   DEFAULT CURRENT_TIMESTAMP(),
  update_time           TIMESTAMP        NOT NULL   DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY           (producto_id)
);

INSERT INTO productos (nombre, sku, categoria, precio, descripcion, codigo_de_barras) VALUES
('shirt','blk-shirt-m','Clothing','25.00','Black shirt medium','9876453210'),
('pants','ble-pants-m','Clothing','75.00','Blue pants medium','159374826'),
('laptop','gry-laptop-c','Electronic','1000.00','Laptop gray core i5','321456789'),
('macbook','gry-macboo-k','Electronic','1250.00','Macbook pro M1 256gb SSD 8gb ram','682475319'),
('iPhone','ble-iphon-e','Electronic','799.00','iPhone 12 128gb','456912387'),
('couch','brw-couch-b','Furniture','650.00','Couch brown big','284615973');