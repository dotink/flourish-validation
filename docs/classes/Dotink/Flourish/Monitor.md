# Monitor
## The monitor is responsible for aggregating validation assets and collecting their output

_Copyright (c) 2015, Matthew J. Sahagian_.
_Please reference the LICENSE.md file at the root of this distribution_

#### Namespace

`Dotink\Flourish`

#### Authors

<table>
	<thead>
		<th>Name</th>
		<th>Handle</th>
		<th>Email</th>
	</thead>
	<tbody>
	
		<tr>
			<td>
				Matthew J. Sahagian
			</td>
			<td>
				mjs
			</td>
			<td>
				msahagian@dotink.org
			</td>
		</tr>
	
	</tbody>
</table>

## Properties

### Instance Properties
#### <span style="color:#6a6e3d;">$formatter</span>

A callable formatter for formatting validation messages




## Methods

### Instance Methods
<hr />

#### <span style="color:#3e6a6e;">__construct()</span>

Create a new validation monitor

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">addAsset()</span>

Add a new object to the monitor as an aliased asset

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$alias
			</td>
			<td>
									<a href="http://php.net/language.types.string">string</a>
				
			</td>
			<td>
				The alias for the object
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			Monitor
		</dt>
		<dd>
			The called instance for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">addCallback()</span>

Add a new callback associate with an alias/asset

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td rowspan="3">
				$asset
			</td>
			<td>
									<a href="http://php.net/language.types.string">string</a>
				
			</td>
			<td rowspan="3">
				The asset with which to associate the callback
			</td>
		</tr>
			
		<tr>
			<td>
									<a href="../../../interfaces/Dotink/Flourish/ValidationInterface.md">ValidationInterface</a>
				
			</td>
		</tr>
								
		<tr>
			<td>
				$callback
			</td>
			<td>
									callable				
			</td>
			<td>
				The callback to handle additional validation
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			Monitor
		</dt>
		<dd>
			The called instance for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">check()</span>

Check if a message exists for a particular alias

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$alias
			</td>
			<td>
									<a href="http://php.net/language.types.string">string</a>
				
			</td>
			<td>
				The asset alias to check
			</td>
		</tr>
					
		<tr>
			<td>
				$message
			</td>
			<td>
									<a href="http://php.net/language.types.string">string</a>
				
			</td>
			<td>
				The message name to check
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			boolean
		</dt>
		<dd>
			TRUE if the message exists, FALSE otherwise
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">compose()</span>

Outputs a validation message to the screen with an optional formatting callback

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$alias
			</td>
			<td>
									<a href="http://php.net/language.types.string">string</a>
				
			</td>
			<td>
				The asset alias to compose
			</td>
		</tr>
					
		<tr>
			<td>
				$message
			</td>
			<td>
									<a href="http://php.net/language.types.string">string</a>
				
			</td>
			<td>
				The message name to compose
			</td>
		</tr>
					
		<tr>
			<td>
				$formatter
			</td>
			<td>
									callable				
			</td>
			<td>
				A callable formatter to output the message
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getAliases()</span>

Get all aliases tracked by the monitor

###### Returns

<dl>
	
		<dt>
			array
		</dt>
		<dd>
			A list of all registered aliases
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">ignore()</span>

Ignore certain validation messages

##### Details

This is useful if there are known instances where you do not have a value yet but you
will post-validation.

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$alias
			</td>
			<td>
									<a href="http://php.net/language.types.string">string</a>
				
			</td>
			<td>
				The asset alias to ignore
			</td>
		</tr>
					
		<tr>
			<td>
				$messages
			</td>
			<td>
									<a href="http://php.net/language.types.array">array</a>
				
			</td>
			<td>
				A list of messages to ignore
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			Monitor
		</dt>
		<dd>
			The called instance for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">scan()</span>

Scan all assets for validation errors

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$return_messages
			</td>
			<td>
									<a href="http://php.net/language.types.boolean">boolean</a>
				
			</td>
			<td>
				Whether or not messages should be returned
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			array
		</dt>
		<dd>
			An array of formatted messages keyed by alias => $message
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">setFormatter()</span>

Set a formatter for the validation messages

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$formatter
			</td>
			<td>
									callable				
			</td>
			<td>
				The formatter callback to use to format messages
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>






