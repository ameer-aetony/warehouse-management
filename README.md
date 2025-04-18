<h1> Warehouse Information System - Backend Documentation </h1>>


Step 1: Core System Setup
Objective
Build a backend system to track item imports/exports, with transactional history and item origin tracing.

Models & Relationships
Model	Fields (Key)	Relationships
Warehouse	id, name, location	Has many WarehouseTransaction
WarehouseTransaction	id, code, date, type_id	Belongs to WarehouseTransactionType
WarehouseTransactionType	id, name (e.g., "inbound", "outbound")	Has many WarehouseTransaction
Item	id, name, commercial_name, code, category_id	Belongs to ItemCategory
ItemCategory	id, name	Has many Item
InTransaction	id, item_id, quantity, price	Morphs to WarehouseTransaction
OutTransaction	id, source_transaction_id (FK to InTransaction), quantity	Morphs to WarehouseTransaction

