<?php

/** 
 * A class used to join two SQL tables together.
 * 
 * @author Ironpilot
 * @copyright Copyright (c) 2011, STAPLE CODE
 * 
 * This file is part of the STAPLE Framework.
 * 
 * The STAPLE Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by the 
 * Free Software Foundation, either version 3 of the License, or (at your option)
 * any later version.
 * 
 * The STAPLE Framework is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for 
 * more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with the STAPLE Framework.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Staple\Query;

class Join
{
	const JOIN = "JOIN";
	const LEFT = "LEFT OUTER JOIN";
	const RIGHT = "RIGHT OUTER JOIN";
	const INNER = "INNER JOIN";
	const CROSS = "CROSS JOIN";
	const STRAIGHT = "STRAIGHT_JOIN";
	const NATURAL = "NATURAL JOIN";
	const NATURAL_LEFT = "NATURAL LEFT JOIN";
	const NATURAL_RIGHT = "NATURAL RIGHT JOIN";
	
	/**
	 * Left Table
	 * @var string
	 */
	protected $leftTable;
	/**
	 * Left Join Column(s)
	 * @var string | array
	 */
	protected $leftColumn;
	/**
	 * Right Table - The table that is being added to the left table.
	 * @var string
	 */
	protected $table;
	/**
	 * The alias of the joined table
	 * @var string
	 */
	protected $tableAlias;
	/**
	 * Right Column(s)
	 * @var string | array
	 */
	protected $rightColumn;
	/**
	 * Join Condition
	 * @var string
	 */
	protected $condition;
	/**
	 * Join Type
	 * @var string
	 */
	protected $type;
	
	/**
	 * Default Constructor
	 * @param string $type
	 * @param string $table
	 * @param string $condition
	 * @param string $leftTable
	 * @param string $leftColumn
	 * @param string $rightColumn
	 */
	public function __construct($type = self::INNER, $table = NULL, $condition = NULL, $leftTable = NULL, $leftColumn = NULL, $rightColumn = NULL, $tableAlias = NULL)
	{
		//Set the Join Type
		$this->setType($type);

		//Set Optional Params
		if(isset($table)) $this->setTable($table);
		if(isset($condition)) $this->setCondition($condition);
		if(isset($leftTable)) $this->setLeftTable($leftTable);
		if(isset($leftColumn)) $this->setLeftColumn($leftColumn);
		if(isset($rightColumn)) $this->setRightColumn($rightColumn);
		if(isset($tableAlias)) $this->setTableAlias($tableAlias);
	}
	
	public function __toString()
	{
		return $this->build();
	}
	
	/**
	 * @return string $leftTable
	 */
	public function getLeftTable()
	{
		return $this->leftTable;
	}

	/**
	 * @return string $leftColumn
	 */
	public function getLeftColumn()
	{
		return $this->leftColumn;
	}

	/**
	 * @return string $table
	 */
	public function getTable()
	{
		return $this->table;
	}

	/**
	 * @return string $rightColumn
	 */
	public function getRightColumn()
	{
		return $this->rightColumn;
	}

	/**
	 * @return string $condition
	 */
	public function getCondition()
	{
		return $this->condition;
	}

	/**
	 * @return string $type
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $leftTable
	 * @return Join
	 */
	public function setLeftTable($leftTable)
	{
		$this->leftTable = $leftTable;
		return $this;
	}

	/**
	 * @param string $leftColumn
	 * @return Join
	 */
	public function setLeftColumn($leftColumn)
	{
		$this->leftColumn = $leftColumn;
		return $this;
	}

	/**
	 * @param string $table
	 * @return Join
	 */
	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}

	/**
	 * @param string $rightColumn
	 * @return Join
	 */
	public function setRightColumn($rightColumn)
	{
		$this->rightColumn = $rightColumn;
		return $this;
	}

	/**
	 * @param string $condition
	 * @return Join
	 */
	public function setCondition($condition)
	{
		$this->condition = $condition;
		return $this;
	}

	/**
	 * @param string $type
	 * @return Join
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTableAlias()
	{
		return $this->tableAlias;
	}

	/**
	 * @param string $tableAlias
	 * @return Join
	 */
	public function setTableAlias($tableAlias)
	{
		$this->tableAlias = $tableAlias;
		return $this;
	}

	public function build()
	{
		$join = $this->getType().' '.$this->table;

		//Add a table alias
		//@todo refactor this to support other DB Types
		if(isset($this->tableAlias))
		{
			$join .= ' `'.$this->tableAlias.'`';
		}

		//Setup the Join Condition
		if(isset($this->condition))
		{
			$join .= ' ON '.$this->condition;
		}
		elseif(isset($this->leftTable) && isset($this->leftColumn) && isset($this->rightColumn))
		{
			$join .= ' ON '.$this->leftTable.'.'.$this->leftColumn.'='.$this->table.'.'.$this->rightColumn;
		}
		return $join;
	}
	
	public static function inner($table, $condition, $alias = NULL)
	{
		return new static(self::INNER,$table,$condition,NULL,NULL,NULL,$alias);
	}
	
	public static function left($table,$condition, $alias = NULL)
	{
		return new static(self::LEFT,$table,$condition,NULL,NULL,NULL,$alias);
	}
}

?>