<?php

namespace IXP\Models;

/*
 * Copyright (C) 2009 - 2020 Internet Neutral Exchange Association Company Limited By Guarantee.
 * All Rights Reserved.
 *
 * This file is part of IXP Manager.
 *
 * IXP Manager is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation, version v2.0 of the License.
 *
 * IXP Manager is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License v2.0
 * along with IXP Manager.  If not, see:
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

use D2EM, Eloquent;

use Entities\Customer as CustomerEntity;

use Illuminate\Database\Eloquent\{Builder,
    Model,
    Relations\BelongsTo,
    Relations\BelongsToMany,
    Relations\HasMany,
    Relations\HasManyThrough,
    Relations\HasOne};

use Illuminate\Support\{
    Collection,
    Carbon as Carbon
};

use IXP\Exceptions\GeneralException as IXP_Exception;

/**
 * IXP\Models\Customer
 *
 * @property int $id
 * @property int|null $irrdb
 * @property int|null $company_registered_detail_id
 * @property int|null $company_billing_details_id
 * @property int|null $reseller
 * @property string|null $name
 * @property int|null $type
 * @property string|null $shortname
 * @property string|null $abbreviatedName
 * @property int|null $autsys
 * @property int|null $maxprefixes
 * @property string|null $peeringemail
 * @property string|null $nocphone
 * @property string|null $noc24hphone
 * @property string|null $nocfax
 * @property string|null $nocemail
 * @property string|null $nochours
 * @property string|null $nocwww
 * @property string|null $peeringmacro
 * @property string|null $peeringmacrov6
 * @property string|null $peeringpolicy
 * @property string|null $corpwww
 * @property Carbon|null $datejoin
 * @property Carbon|null $dateleave
 * @property int|null $status
 * @property int|null $activepeeringmatrix
 * @property Carbon|null $lastupdated
 * @property int|null $lastupdatedby
 * @property string|null $creator
 * @property Carbon|null $created
 * @property string|null $MD5Support
 * @property int $isReseller
 * @property int $in_manrs
 * @property int $in_peeringdb
 * @property int $peeringdb_oauth
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\ConsoleServerConnection[] $consoleServerConnections
 * @property-read int|null $console_server_connections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\DocstoreCustomerDirectory[] $docstoreCustomerDirectories
 * @property-read int|null $docstore_customer_directories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\DocstoreCustomerFile[] $docstoreCustomerFiles
 * @property-read int|null $docstore_customer_files_count
 * @property-read \IXP\Models\IrrdbConfig|null $irrdbConfig
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\IrrdbPrefix[] $irrdbPrefixes
 * @property-read int|null $irrdb_prefixes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\RouteServerFilter[] $peerrouteserverfilters
 * @property-read int|null $peerrouteserverfilters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\RouteServerFilter[] $routeserverfilters
 * @property-read int|null $routeserverfilters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\TrafficDaily[] $trafficDailies
 * @property-read int|null $traffic_dailies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\VirtualInterface[] $virtualInterfaces
 * @property-read int|null $virtual_interfaces_count
 * @method static Builder|Customer current()
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer trafficking()
 * @method static Builder|Customer whereAbbreviatedName($value)
 * @method static Builder|Customer whereActivepeeringmatrix($value)
 * @method static Builder|Customer whereAutsys($value)
 * @method static Builder|Customer whereCompanyBillingDetailsId($value)
 * @method static Builder|Customer whereCompanyRegisteredDetailId($value)
 * @method static Builder|Customer whereCorpwww($value)
 * @method static Builder|Customer whereCreated($value)
 * @method static Builder|Customer whereCreator($value)
 * @method static Builder|Customer whereDatejoin($value)
 * @method static Builder|Customer whereDateleave($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereInManrs($value)
 * @method static Builder|Customer whereInPeeringdb($value)
 * @method static Builder|Customer whereIrrdb($value)
 * @method static Builder|Customer whereIsReseller($value)
 * @method static Builder|Customer whereLastupdated($value)
 * @method static Builder|Customer whereLastupdatedby($value)
 * @method static Builder|Customer whereMD5Support($value)
 * @method static Builder|Customer whereMaxprefixes($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer whereNoc24hphone($value)
 * @method static Builder|Customer whereNocemail($value)
 * @method static Builder|Customer whereNocfax($value)
 * @method static Builder|Customer whereNochours($value)
 * @method static Builder|Customer whereNocphone($value)
 * @method static Builder|Customer whereNocwww($value)
 * @method static Builder|Customer wherePeeringdbOauth($value)
 * @method static Builder|Customer wherePeeringemail($value)
 * @method static Builder|Customer wherePeeringmacro($value)
 * @method static Builder|Customer wherePeeringmacrov6($value)
 * @method static Builder|Customer wherePeeringpolicy($value)
 * @method static Builder|Customer whereReseller($value)
 * @method static Builder|Customer whereShortname($value)
 * @method static Builder|Customer whereStatus($value)
 * @method static Builder|Customer whereType($value)
 * @mixin Eloquent
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\RouteServerFilter[] $peerRouteServerFilters
 * @property-read int|null $peer_route_server_filters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\RouteServerFilter[] $routeServerFilters
 * @property-read int|null $route_server_filters_count
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\Customer currentActive($trafficing = false, $externalOnly = false, $connected = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\Customer whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\PatchPanelPort[] $patchPanelPorts
 * @property-read int|null $patch_panel_ports_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\PatchPanelPortHistory[] $patchPanelPortHistories
 * @property-read int|null $patch_panel_port_histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\CustomerTag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\Logo[] $logos
 * @property-read int|null $logos_count
 * @property-read \IXP\Models\Logo|null $logo
 * @property-read Customer|null $resellerObject
 * @property-read \Illuminate\Database\Eloquent\Collection|Customer[] $resoldCustomers
 * @property-read int|null $resold_customers_count
 * @property-read \IXP\Models\CompanyBillingDetail|null $companyBillingDetail
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\VlanInterface[] $vlanInterfaces
 * @property-read int|null $vlan_interfaces_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\PeeringManager[] $peers
 * @property-read int|null $peers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\PeeringManager[] $peersWith
 * @property-read int|null $peers_with_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\RsPrefix[] $rsPrefixes
 * @property-read int|null $rs_prefixes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\CustomerNote[] $customerNotes
 * @property-read int|null $customer_notes_count
 */
class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cust';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'datejoin',
        'dateleave'
    ];

    /**
     * DQL for selecting customers that are current in terms of `datejoin` and `dateleave`
     *
     * @var string DQL for selecting customers that are current in terms of `datejoin` and `dateleave`
     */
    public const SQL_CUST_CURRENT = "cust.datejoin <= CURRENT_DATE() AND ( cust.dateleave IS NULL OR cust.dateleave >= CURRENT_DATE() )";

    /**
     * DQL for selecting customers that are active (i.e. not suspended)
     *
     * @var string DQL for selecting customers that are active (i.e. not suspended)
     */
    public const SQL_CUST_ACTIVE = "cust.status IN ( 1, 2 )";

    /**
     * DQL for selecting all trafficing customers
     *
     * @var string DQL for selecting all trafficing customers
     */
    public const SQL_CUST_TRAFFICING = "cust.type != 2";

    /**
     * DQL for selecting all customers except for internal / dummy customers
     *
     * @var string DQL for selecting all customers except for internal / dummy customers
     */
    public const SQL_CUST_EXTERNAL = "cust.type != 3";

    /**
     * DQL for selecting all "connected" customers
     *
     * @var string DQL for selecting all "connected" customers
     */
    public const SQL_CUST_CONNECTED = "cust.status = 1";


    public const TYPE_FULL        = 1;
    public const TYPE_ASSOCIATE   = 2;
    public const TYPE_INTERNAL    = 3;
    public const TYPE_PROBONO     = 4;

    public static $CUST_TYPES_TEXT = [
        self::TYPE_FULL          => 'Full',
        self::TYPE_ASSOCIATE     => 'Associate',
        self::TYPE_INTERNAL      => 'Internal',
        self::TYPE_PROBONO       => 'Pro-bono',
    ];

    public const STATUS_NORMAL       = 1;
    public const STATUS_NOTCONNECTED = 2;
    public const STATUS_SUSPENDED    = 3;

    public static $CUST_STATUS_TEXT = [
        self::STATUS_NORMAL           => 'Normal',
        self::STATUS_NOTCONNECTED     => 'Not Connected',
        self::STATUS_SUSPENDED        => 'Suspended',
    ];

    public const PEERING_POLICY_OPEN       = 'open';
    public const PEERING_POLICY_SELECTIVE  = 'selective';
    public const PEERING_POLICY_MANDATORY  = 'mandatory';
    public const PEERING_POLICY_CLOSED     = 'closed';

    public static $PEERING_POLICIES = [
        self::PEERING_POLICY_OPEN       => 'open',
        self::PEERING_POLICY_SELECTIVE  => 'selective',
        self::PEERING_POLICY_MANDATORY  => 'mandatory',
        self::PEERING_POLICY_CLOSED     => 'closed'
    ];

    public const NOC_HOURS_24x7 = '24x7';
    public const NOC_HOURS_8x5  = '8x5';
    public const NOC_HOURS_8x7  = '8x7';
    public const NOC_HOURS_12x5 = '12x5';
    public const NOC_HOURS_12x7 = '12x7';

    public static $NOC_HOURS = [
        self::NOC_HOURS_24x7 => '24x7',
        self::NOC_HOURS_8x5  => '8x5',
        self::NOC_HOURS_8x7  => '8x7',
        self::NOC_HOURS_12x5 => '12x5',
        self::NOC_HOURS_12x7 => '12x7'
    ];


    /**
     * Get the virtual interfaces for the customer
     */
    public function virtualInterfaces(): HasMany
    {
        return $this->hasMany(VirtualInterface::class, 'custid');
    }

    /**
     * Get the peers for the customer
     */
    public function peers(): HasMany
    {
        return $this->hasMany(PeeringManager::class, 'custid');
    }

    /**
     * Get the peers with for the customer
     */
    public function peersWith(): HasMany
    {
        return $this->hasMany(PeeringManager::class, 'peerid');
    }

    /**
     * Get the virtual interfaces for the customer
     */
    public function vlanInterfaces(): HasManyThrough
    {
        return $this->hasManyThrough( VlanInterface::class, VirtualInterface::class,
            'custid', 'virtualinterfaceid'
        );
    }

    /**
     * Get the docstore customer directories for the customer
     */
    public function docstoreCustomerDirectories(): HasMany
    {
        return $this->hasMany(DocstoreCustomerDirectory::class, 'cust_id');
    }

    /**
     * Get the docstore customer files for the customer
     */
    public function docstoreCustomerFiles(): HasMany
    {
        return $this->hasMany(DocstoreCustomerFile::class, 'cust_id');
    }

    /**
     * Get the contacts for the customer
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, 'custid' );
    }

    /**
     * Get the console server connections for the customer
     */
    public function consoleServerConnections(): HasMany
    {
        return $this->hasMany(ConsoleServerConnection::class, 'custid');
    }

    /**
     * Get the route server filters for the customer
     */
    public function routeServerFilters(): HasMany
    {
        return $this->hasMany(RouteServerFilter::class, 'customer_id' );
    }

    /**
     * Get the peer route server filters for the customer
     */
    public function peerRouteServerFilters(): HasMany
    {
        return $this->hasMany(RouteServerFilter::class, 'peer_id' );
    }

    /**
     * Get the irrdb Prefixes for the customer
     */
    public function irrdbPrefixes(): HasMany
    {
        return $this->hasMany(IrrdbPrefix::class, 'customer_id' );
    }

    /**
     * Get the traffic dailies for the customer
     */
    public function trafficDailies(): HasMany
    {
        return $this->hasMany(TrafficDaily::class, 'cust_id' );
    }

    /**
     * Get the patch panel portss for the customer
     */
    public function patchPanelPorts(): HasMany
    {
        return $this->hasMany(PatchPanelPort::class, 'customer_id' );
    }

    /**
     * Get the patch panel port histories for the customer
     */
    public function patchPanelPortHistories(): HasMany
    {
        return $this->hasMany(PatchPanelPortHistory::class, 'cust_id' );
    }

    /**
     * Get the rsPrefixes for the customer
     */
    public function rsPrefixes(): HasMany
    {
        return $this->hasMany(RsPrefix::class, 'custid' );
    }

    /**
     * Get the customer notes for the customer
     */
    public function customerNotes(): HasMany
    {
        return $this->hasMany(CustomerNote::class, 'customer_id' );
    }

    /**
     * Get the logo for the customer
     */
    public function logo(): HasOne
    {
        return $this->hasOne(Logo::class, 'customer_id' );
    }

    /**
     * Get the logo for the customer
     */
    public function companyBillingDetail(): BelongsTo
    {
        return $this->belongsTo(CompanyBillingDetail::class, 'company_billing_details_id' );
    }

    /**
     * Get the resold customers for the customer
     */
    public function resoldCustomers(): hasMany
    {
        return $this->hasMany( __CLASS__, 'reseller' );
    }

    /**
     * Get the reseller for the customer
     */
    public function resellerObject(): BelongsTo
    {
        return $this->belongsTo( __CLASS__, 'reseller' );
    }

    /**
     * Get the irrdbconfig that own the customer
     */
    public function irrdbConfig(): BelongsTo
    {
        return $this->belongsTo(IrrdbConfig::class, 'irrdb' );
    }

    /**
     * Get all the users for the customer
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class )->withPivot( 'customer_to_users', 'customer_id' );
    }

    /**
     * The tags that belong to the customer.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(CustomerTag::class , 'cust_to_cust_tag', 'customer_id' );
    }

    /**
     * Check if this customer is of the named type
     * @return boolean
     */
    public function typeInternal(): bool
    {
        return $this->type === self::TYPE_INTERNAL;
    }

    /**
     * Check if this customer is of the named type
     *
     * @return boolean
     */
    public function typeFull(): bool
    {
        return $this->type === self::TYPE_FULL;
    }

    /**
     * Check if this customer is of the named type
     *
     * @return boolean
     */
    public function typeProBono(): bool
    {
        return $this->type === self::TYPE_PROBONO;
    }

    /**
     * Check if this customer is of the named type
     *
     * @return boolean
     */
    public function typeAssociate(): bool
    {
        return $this->type === self::TYPE_ASSOCIATE;
    }

    /**
     * Returns true if the customer's status is NORMAL
     *
     * @return bool True if the customer's status is NORMAL
     */
    public function statusNormal(): bool
    {
        return $this->status === self::STATUS_NORMAL;
    }

    /**
     * Returns true if the customer's status is NOTCONNECTED
     *
     * @return bool True if the customer's status is NOTCONNECTED
     */
    public function statusNotConnected(): bool
    {
        return $this->status === self::STATUS_NOTCONNECTED;
    }

    /**
     * Returns true if the customer's status is SUSPENDED
     *
     * @return bool True if the customer's status is SUSPENDED
     */
    public function statusSuspended(): bool
    {
        return $this->status === self::STATUS_SUSPENDED;
    }

    /**
     * Returns true if the customer has left
     *
     * @return bool
     */
    public function hasLeft(): bool
    {
        // sigh. Using a date field to determine if an account is closed or not is a
        // very bad idea and should be changed => FIXME
        return $this->dateleave != null;
    }

    /**
     * Scope a query to only include trafficking members.
     *
     * Not that the IXP's own internal customers are included in this.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeTrafficking( Builder $query ): Builder
    {
        return $query->where('type', '!=', Customer::TYPE_ASSOCIATE );
    }

    /**
     * Scope a query to only include current members
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeCurrent( Builder $query): Builder
    {
        return $query->where('datejoin', '<=', today() )
            ->where( function ( Builder $query) {
                $query->whereNull( 'dateleave' )
                    ->orWhere( 'dateleave', '=', '0000-00-00' )
                    ->orWhere( 'dateleave', '>=', today() );
            });
    }

    /**
     * Utility function to provide a array of all active and current customers.
     *
     * @param Builder $query
     * @param bool $trafficing      If `true`, only include trafficing customers (i.e. no associates)
     * @param bool $externalOnly    If `true`, only include external customers (i.e. no internal types)
     * @param bool $connected       If `true`, only include connected customers
     * 
     * @return Builder
     */
    public static function scopeCurrentActive( Builder $query, bool $trafficing = false, bool $externalOnly = false, bool $connected = true ): Builder
    {
        return $query->whereRaw( self::SQL_CUST_CURRENT )
            ->whereRaw( self::SQL_CUST_ACTIVE )
            ->when( $trafficing , function( Builder $q ) use( $connected ) {
                return $q->whereRaw(self::SQL_CUST_TRAFFICING )
                    ->when( $connected , function( Builder $q ) {
                        return $q->whereRaw( self::SQL_CUST_CONNECTED );
                    });
            } )->when( $externalOnly , function( Builder $q ) {
                return $q->whereRaw( self::SQL_CUST_EXTERNAL );
            })->orderBy( 'name' );
    }

    /**
     * Useful function to get the appropriate AS macro or ASN for a customer
     * for a given protocol.
     *
     * One example usage is in IrrdbCli for bgpq3. bgpq3 requires ASNs to
     * be formatted as `asxxxx` so we set `$asnPrefix = 'as'` in this case.
     *
     * By default, the function will return some format of the ASN if no macro is
     * defined. To return null in this case, set `$nullIfNoMacro` to true.
     *
     * @param int    $protocol One of 4 or 6 (defaults to 4)
     * @param string $asnPrefix A prefix for the ASN if no macro is present. See above.
     * @param bool   $nullIfNoMacro
     *
     * @return string|null The ASN / AS macro as appropriate
     */
    public function asMacro( $protocol = 4, $asnPrefix = '', $nullIfNoMacro = false ): ?string
    {
        if( !in_array( $protocol, [ 4, 6 ], true ) )
            throw new \IXP_Exception( 'Invalid / unknown protocol. 4/6 accepted only.' );

        // find the appropriate ASN or macro
        if( $protocol === 6 && strlen( $this->peeringmacrov6 ) > 3 ) {
            $asmacro = $this->peeringmacrov6;
        } else if( strlen( $this->peeringmacro ) > 3 ) {
            $asmacro = $this->peeringmacro;
        } else if( $nullIfNoMacro ) {
            $asmacro = null;
        } else {
            $asmacro = $asnPrefix . $this->autsys;
        }

        return $asmacro;
    }

    /**
     * Get formatted name
     *
     * @param null $fmt
     *
     * @return string
     */
    public function getFormattedName( $fmt = null ): string
    {
        if( $this->type === self::TYPE_ASSOCIATE ) {
            return $this->abbreviatedName;
        }

        if( $fmt === null || ( $fmt = config('ixp_fe.customer_name_format') ) === null ) {
            $fmt = "%a %j";
        }

        $as = $this->autsys ?: false;

        return str_replace(
            [ '%n', '%a', '%s', '%i', '%j', '%k', '%l' ],
            [
                $this->name,
                $this->abbreviatedName,
                $this->shortname,
                $as ? $as          : '',
                $as ? "[AS{$as}]"  : '',
                $as ? "AS{$as}"    : '',
                $as ? " - AS{$as}" : ''
            ],
            $fmt
        );
    }

    /**
     * Return the given type as string
     *
     * @param int $t
     *
     * @return string
     */
    public static function givenType( int $t ): string
    {
        return self::$CUST_TYPES_TEXT[ $t ] ?? 'Unknwon';
    }

    /**
     * Is the customer a route server client on any of their VLAN interfaces?
     *
     * @param int $proto One of [4,6]. Defaults to 4.
     *
     * @return boolean
     *
     * @throws
     */
    public function routeServerClient( int $proto = 4 ): bool
    {
        if( !in_array( $proto, [ 4, 6 ] ) ) {
            throw new IXP_Exception( 'Invalid protocol' );
        }

        foreach( $this->virtualInterfaces as $vi ) {
            foreach( $vi->vlanInterfaces as $vli ) {
                if( $vli->ipvxEnabled( $proto ) && $vli->rsclient ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Is the customer IRRDB filtered (usually for route server clients) on any of their VLAN interfaces?
     *
     * @return boolean
     */
    public function irrdbFiltered(): bool
    {
        return (bool)self::leftJoin( 'virtualinterface AS vi', 'vi.custid', 'cust.id' )
            ->leftJoin( 'vlaninterface AS vli', 'vli.virtualinterfaceid', 'vi.id' )
            ->where( 'cust.id', $this->id )->where( 'irrdbfilter', true )
            ->get()->count();
    }

    /**
     * Is the customer IPvX enabled on any of their VLAN interfaces?
     * @param int $proto One of [4,6]. Defaults to 4.
     * @return boolean
     * @throws IXP_Exception
     */
    public function isIPvXEnabled( int $proto = 4 ): bool
    {
        if( !in_array( $proto, [ 4, 6 ] ) ) {
            throw new IXP_Exception( 'Invalid protocol' );
        }

        foreach( $this->virtualInterfaces as $vi ) {
            foreach( $vi->vlanInterfaces as $vli ) {
                if( $vli->ipvxEnabled( $proto ) ) {
                    return true;
                }
            }
        }

        return false;
    }



    /**
     * Is this customer graphable?
     *
     * @return bool
     */
    public function isGraphable(): bool
    {
        foreach( $this->virtualInterfaces as $vi ) {
            if( $vi->isGraphable() ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Does the customer have any interfaces in quarantine/connected?
     *
     * I.e. does the customer have graphable interfaces?
     *
     * @return bool
     */
    public function hasInterfacesConnectedOrInQuarantine(): bool
    {
        foreach( $this->virtualInterfaces as $vi ) {
            foreach( $vi->physicalInterfaces as $pi ) {
                if( $pi->isConnectedOrQuarantine() ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Utility function to provide a array of all members connected to the exchange (including at
     * least one physical interface with status 'CONNECTED').
     *
     * @param bool      $externalOnly   If `true`, only include external customers (i.e. no internal types)
     * @param bool      $active         If `true`, only include active customers
     * @param string    $orderBy
     * @param string    $direction      Direction for the order by
     *
     * @return Collection
     */
    public static function getConnected( $externalOnly = false, $active = false , string $orderBy = 'name', string $direction = 'asc' ): Collection
    {
        return self::select( 'cust.*' )
            ->leftJoin( 'virtualinterface AS vi', 'vi.custid', 'cust.id'  )
            ->leftJoin( 'physicalinterface AS pi', 'pi.virtualinterfaceid', 'vi.id' )
            ->whereRaw( self::SQL_CUST_CURRENT )
            ->whereRaw(self::SQL_CUST_TRAFFICING )
            ->where('pi.status', PhysicalInterface::STATUS_CONNECTED )
            ->when( $externalOnly , function( Builder $q ) {
                return $q->whereRaw( self::SQL_CUST_EXTERNAL );
            })
            ->when( $active , function( Builder $q ) {
                return $q->whereRaw( self::SQL_CUST_ACTIVE );
            })
            ->orderBy( 'cust.' . $orderBy , $direction )->distinct()->get();
    }

    /**
     * Does the customer have any interfaces in quarantine?
     *
     * @return bool
     */
    public function hasInterfacesInQuarantine(): bool
    {
        return (bool)self::leftJoin( 'virtualinterface AS vi', 'vi.custid', 'cust.id' )
            ->leftJoin( 'physicalinterface AS pi', 'pi.virtualinterfaceid', 'vi.id' )
            ->where( 'cust.id', $this->id )->where( 'pi.status', PhysicalInterface::STATUS_QUARANTINE )
            ->get()->count();
    }

    /**
     * Does the customer have private VLANs?
     *
     * A private VLAN is a VLAN between a subset of members (usually
     * just two).
     *
     * @return bool
     */
    public function hasPrivateVlans(): bool
    {
        return (bool)self::leftJoin( 'virtualinterface AS vi', 'vi.custid', 'cust.id' )
            ->leftJoin( 'vlaninterface AS vli', 'vli.virtualinterfaceid', 'vi.id' )
            ->leftJoin( 'vlan AS v', 'v.id', 'vli.vlanid' )
            ->where( 'v.private', true )->where( 'cust.id', $this->id )
            ->get()->count();
    }

    /**
     * Get private VLAN information as an associate array
     *
     * Useful utility function for displaying a customers private VLANs in the
     * overview page and the customer's own portal.
     *
     * Response is an array such as:
     *
     *     [8] => [                          // VLAN ID
     *         [vlis] => [
     *             // VlanInterface objects for the customer that are on this private VLAN
     *         ],
     *         [members] => [
     *             // Customer objects for all customers (including this one) that share this VLAN
     *         ]
     *     ]
     *
     *
     * @return array Private VLAN details
     */
    public function privateVlanDetails(): array
    {
        $pvlans = [];

        foreach( $this->vlanInterfaces as $vli ){
            if( $vli->vlan->private ) {
                $pvlans[ $vli->vlanid ][ 'vlis' ][] = $vli;

                foreach( $vli->vlan->vlanInterfaces as $vli2 ) {
                    $pvlans[ $vli->vlanid ][ 'members' ][ $vli2->virtualInterface->custid ]
                        = $vli2->virtualInterface->customer;
                }
            }
        }
        return $pvlans;
    }
}