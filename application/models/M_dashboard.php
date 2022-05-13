<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_dashboard extends CI_Model
{



  public function __construct()

  {

    parent::__construct();
  }



  function getData()

  {

    $query = $this->db->get("view_dashboard");
    return $query->result();
  }

  function getDataNon()

  {

    $query = $this->db->get("view_dashboard_non");
    return $query->result();
  }

  function getTargetAndTotal()
  {
    $sql = "select kabupaten_target,target,COALESCE(total,0) as total from (
      select bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos bn
      join tb_mtg nm
      on bn.id = nm.bansos_id
      and bn.flag = 1
      join shipping_mtg s
      on nm.shipping_id = s.id
      and s.status = 1
      group by s.kabupaten) a
      right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos bn
      group by kabupaten) b
      on a.kabupaten_total = b.kabupaten_target
      UNION ALL
      select kabupaten_target,target,COALESCE(total,0) as total from (
      select kabupaten as kabupaten_total,sum(qty) as total from shipping
      where status = 1
      and kabupaten like 'JAKARTA%'
      group by kabupaten) a
      right join (select kabupaten as kabupaten_target,count(id) as target from bansos_non
      where kabupaten like 'JAKARTA%'
      group by kabupaten) b
      on a.kabupaten_total = b.kabupaten_target
      union ALL
      select kabupaten_target,target,COALESCE(total,0) as total from (
      select SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten_total,sum(qty) as total from shipping
      where status = 1
      and kabupaten not like 'JAKARTA%'
      group by kabupaten) a
      right join (select SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten_target,count(id) as target from bansos_non
      where kabupaten not like 'JAKARTA%'
      group by kabupaten) b
      on a.kabupaten_total = b.kabupaten_target";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getDataOk()
  {
    $sql = 'select * from (
        select s.date_manifest as shipping_date ,bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos bn
        join tb_mtg nm
        on bn.id = nm.bansos_id
        and bn.flag = 1
        join shipping_mtg s
        on nm.shipping_id = s.id
        and s.status = 1
        group by s.kabupaten) a
        right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos bn
        group by kabupaten) b
        on a.kabupaten_total = b.kabupaten_target';
    $query = $this->db->query($sql);
    return $query->row();
  }

  function getReportDayNon()
  {
    $sql = 'select * from (
        select s.shipping_date,bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos_non bn
        join non_mtg nm
        on bn.id = nm.bansos_id
        and bn.status = 200
        join shipping s
        on nm.shipping_id = s.id
        and s.status = 1
        group by s.shipping_date,bn.kabupaten) a
        right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos_non bn
        group by kabupaten) b
        on a.kabupaten_total = b.kabupaten_target';
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getReportDayJakbar()
  {
    $sql = 'select * from (
          select s.date_manifest as shipping_date ,bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos bn
          join tb_mtg nm
          on bn.id = nm.bansos_id
          and bn.flag = 1
          join shipping_mtg s
          on nm.shipping_id = s.id
          and s.status = 1
          group by s.date_manifest,s.kabupaten) a
          right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos bn
          group by kabupaten) b
          on a.kabupaten_total = b.kabupaten_target';
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getKabupatenList()
  {
    // $this->db->distinct();
    // $this->db->select('kabupaten');
    // $query = $this->db->get("bansos_non");
    $sql = "SELECT DISTINCT(kabupaten) from bansos
    UNION
    SELECT * FROM
    (SELECT DISTINCT(kabupaten) from bansos_non
    WHERE kabupaten LIKE 'JAKARTA %'
    ORDER BY 1) a
    UNION
    SELECT * FROM
    (SELECT DISTINCT(SUBSTRING_INDEX(kabupaten,'KOTA ',-1)) from bansos_non
    ORDER BY 1) b";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getListData()
  {
    $sql = "select * from ( 
      select 2 as filter,shipping_date,kabupaten_target,COALESCE(total,0) as total from (
              select shipping_date,kabupaten as kabupaten_total,sum(qty) as total from shipping
              where status = 1
							and kabupaten like 'JAKARTA %'
              GROUP BY shipping_date,kabupaten) a
              right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target 
							from bansos_non bn
							where bn.kabupaten like 'JAKARTA %'
              group by kabupaten) b
              on a.kabupaten_total = b.kabupaten_target
			UNION ALL
			select 3 as filter,shipping_date,kabupaten_target,COALESCE(total,0) as total from (
              select shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten_total,COALESCE(sum(qty),0) as total from shipping
              where status = 1
							and kabupaten not like 'JAKARTA %'
              group by shipping_date,kabupaten) a
              right join (select SUBSTRING_INDEX(bn.kabupaten,'KOTA ',-1) as kabupaten_target,count(bn.id) as target 
							from bansos_non bn
							where bn.kabupaten not like 'JAKARTA %'
              group by kabupaten) b
              on a.kabupaten_total = b.kabupaten_target
			union ALL
			select 1 as filter,date_manifest,kabupaten_target,COALESCE(total,0) as total from (
              select s.date_manifest,bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos bn
              join tb_mtg nm
              on bn.id = nm.bansos_id
              join shipping_mtg s
              on nm.shipping_id = s.id
              and s.status = 1
              group by s.date_manifest,bn.kabupaten) a
              right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos bn
              group by kabupaten) b
              on a.kabupaten_total = b.kabupaten_target
) a
      where a.shipping_date is not null
      order by 2,1,3";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getTotal()
  {
    $sql = "select filter,kabupaten_target,sum(total) as sum from (
      select 2 as filter,shipping_date,kabupaten_target,COALESCE(total,0) as total from (
              select shipping_date,kabupaten as kabupaten_total,sum(qty) as total from shipping
              where status = 1
							and kabupaten like 'JAKARTA %'
              group by kabupaten) a
              right join (select kabupaten as kabupaten_target,count(id) as target from bansos_non
							where kabupaten like 'JAKARTA %'
              group by kabupaten) b
              on a.kabupaten_total = b.kabupaten_target
			UNION ALL
			select 3 as filter,shipping_date,kabupaten_target,COALESCE(total,0) as total from (
              select shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten_total,sum(qty) as total from shipping
              where status = 1
							and kabupaten not like 'JAKARTA %'
              group by kabupaten) a
              right join (select SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten_target,count(id) as target from bansos_non
							where kabupaten not like 'JAKARTA %'
              group by kabupaten) b
              on a.kabupaten_total = b.kabupaten_target
			union ALL
			select 1 as filter,date_manifest as shipping_date,kabupaten_target,COALESCE(total,0) as total from (
              select s.date_manifest,bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos bn
              join tb_mtg nm
              on bn.id = nm.bansos_id
              join shipping_mtg s
              on nm.shipping_id = s.id
              and s.status = 1
              group by s.date_manifest,bn.kabupaten) a
              right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos bn
              group by kabupaten) b
              on a.kabupaten_total = b.kabupaten_target
) a
      where a.shipping_date is not null
GROUP BY kabupaten_target
      order by 1,2";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getTarget()
  {
    $sql = "SELECT * FROM (
      SELECT 1 as filter,kabupaten as kabupaten,count(id) as target
      FROM bansos
      GROUP BY kabupaten
      UNION ALL
      SELECT 2 as filter,kabupaten as kabupaten,count(id) as target
      FROM bansos_non
			WHERE kabupaten LIKE 'JAKARTA %'
      GROUP BY kabupaten
      UNION ALL
      SELECT 3 as filter,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten,count(id) as target
      FROM bansos_non
			WHERE kabupaten NOT LIKE 'JAKARTA %'
      GROUP BY kabupaten) a
    ORDER BY 1,2";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getTruckRit()
  {
    $sql = "SELECT date_manifest,a.kabupaten,truck,rit,total from (
      SELECT 1 as filter, date_manifest,kabupaten,sum(trip) as rit
      FROM(SELECT date_manifest,kabupaten,truck_id,CASE when high - low < 3 then 1 else 2 end as trip FROM (
      SELECT date_manifest,kabupaten,truck_id,min(MID(created_date,12,2)) as low,max(MID(created_date,12,2)) as high FROM shipping_mtg
      where status = 1
      GROUP BY 1,2,3) a)a
      GROUP BY date_manifest
      UNION ALL
      SELECT 2 as filter, shipping_date,kabupaten,sum(trip) as rit
      FROM(SELECT shipping_date,kabupaten,truck_id,CASE when high - low < 3 then 1 else 2 end as trip FROM (
      SELECT shipping_date,kabupaten,truck_id,min(MID(created_date,12,2)) as low,max(MID(created_date,12,2)) as high FROM shipping
      where status = 1
      and kabupaten != '0'
      GROUP BY 1,2,3) b)a
      WHERE kabupaten like 'JAKARTA %'
      GROUP BY shipping_date,kabupaten
      UNION ALL
      SELECT 3 as filter, shipping_date,kabupaten,COUNT(trip)
      FROM(SELECT shipping_date,kabupaten,truck_id,CASE when high - low < 3 then 1 else 2 end as trip FROM (
      SELECT shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten,truck_id,min(MID(created_date,12,2)) as low,max(MID(created_date,12,2)) as high FROM shipping
      where status = 1
      and kabupaten != '0'
      GROUP BY 1,2,3) b)a
      WHERE kabupaten not like 'JAKARTA %'
      GROUP BY shipping_date,kabupaten
      ORDER BY 2,1,3 ) a
      JOIN (
      SELECT shipping_date,kabupaten,count(truck_id) as truck from(
      SELECT shipping_date,kabupaten,truck_id from shipping
      where status = 1
      GROUP BY shipping_date,kabupaten,truck_id) a
      WHERE kabupaten like 'JAKARTA %'
      GROUP BY shipping_date,kabupaten
      UNION ALL 
      SELECT shipping_date,kabupaten,count(truck_id) from(
      SELECT shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten,truck_id from shipping
      where status = 1
      GROUP BY shipping_date,kabupaten,truck_id) a
      WHERE kabupaten not like 'JAKARTA %'
      GROUP BY shipping_date,kabupaten
      UNION ALL 
      SELECT date_manifest,kabupaten,count(truck_id) from(
      SELECT date_manifest, kabupaten,truck_id from shipping_mtg
      where status = 1
      GROUP BY date_manifest,kabupaten,truck_id) a
      GROUP BY date_manifest,kabupaten) b
      on a.date_manifest = b.shipping_date
      and a.kabupaten = b.kabupaten
      JOIN (
      select * from ( 
            select 2 as filter,shipping_date,kabupaten_target,COALESCE(total,0) as total from (
                    select shipping_date,kabupaten as kabupaten_total,sum(qty) as total from shipping
                    where status = 1
                    and kabupaten like 'JAKARTA %'
                    GROUP BY shipping_date,kabupaten) a
                    right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target 
                    from bansos_non bn
                    where bn.kabupaten like 'JAKARTA %'
                    group by kabupaten) b
                    on a.kabupaten_total = b.kabupaten_target
            UNION ALL
            select 3 as filter,shipping_date,kabupaten_target,COALESCE(total,0) as total from (
                    select shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten_total,COALESCE(sum(qty),0) as total from shipping
                    where status = 1
                    and kabupaten not like 'JAKARTA %'
                    group by shipping_date,kabupaten) a
                    right join (select SUBSTRING_INDEX(bn.kabupaten,'KOTA ',-1) as kabupaten_target,count(bn.id) as target 
                    from bansos_non bn
                    where bn.kabupaten not like 'JAKARTA %'
                    group by kabupaten) b
                    on a.kabupaten_total = b.kabupaten_target
            union ALL
            select 1 as filter,date_manifest,kabupaten_target,COALESCE(total,0) as total from (
                    select s.date_manifest,bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos bn
                    join tb_mtg nm
                    on bn.id = nm.bansos_id
                    join shipping_mtg s
                    on nm.shipping_id = s.id
                    and s.status = 1
                    group by s.date_manifest,bn.kabupaten) a
                    right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos bn
                    group by kabupaten) b
                    on a.kabupaten_total = b.kabupaten_target
      ) a
            where a.shipping_date is not null
            order by 2,1,3) c
      on a.date_manifest=c.shipping_date
      and a.kabupaten=c.kabupaten_target";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getTotalTruckRit()
  {
    $sql = "SELECT a.kabupaten,truck,rit,total from (
			SELECT 1 as filter, kabupaten,sum(trip) as rit
      FROM(SELECT date_manifest,kabupaten,truck_id,driver_id,CASE when high - low < 3 then 1 else 2 end as trip FROM (
      SELECT date_manifest,kabupaten,truck_id,driver_id,min(MID(created_date,12,2)) as low,max(MID(created_date,12,2)) as high FROM shipping_mtg
      where status = 1
      GROUP BY 1,2,3,4) a)a
      GROUP BY kabupaten
			UNION ALL
      SELECT 2 as filter, kabupaten,sum(trip) as rit
      FROM(SELECT shipping_date,kabupaten,truck_id,driver_id,CASE when high - low < 3 then 1 else 2 end as trip FROM (
      SELECT shipping_date,kabupaten,truck_id,driver_id,min(MID(created_date,12,2)) as low,max(MID(created_date,12,2)) as high FROM shipping
      where status = 1
      and kabupaten != '0'
      GROUP BY 1,2,3,4) b)a
      WHERE kabupaten like 'JAKARTA %'
      GROUP BY kabupaten
			UNION ALL
      SELECT 3 as filter, kabupaten,sum(trip) as rit
      FROM(SELECT shipping_date,kabupaten,truck_id,driver_id,CASE when high - low < 3 then 1 else 2 end as trip FROM (
      SELECT shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten,truck_id,driver_id,min(MID(created_date,12,2)) as low,max(MID(created_date,12,2)) as high FROM shipping
      where status = 1
      and kabupaten != '0'
      GROUP BY 1,2,3,4) b)a
      WHERE kabupaten not like 'JAKARTA %'
      GROUP BY kabupaten
      ORDER BY 2,1,3 ) a
JOIN (
      SELECT kabupaten,count(truck_id) as truck from(
      SELECT shipping_date,kabupaten,truck_id from shipping
      where status = 1
      GROUP BY shipping_date,kabupaten,truck_id) a
      WHERE kabupaten like 'JAKARTA %'
      GROUP BY kabupaten
      UNION ALL 
      SELECT kabupaten,count(truck_id) from(
      SELECT shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten,truck_id from shipping
      where status = 1
      GROUP BY shipping_date,kabupaten,truck_id) a
      WHERE kabupaten not like 'JAKARTA %'
      GROUP BY kabupaten
      UNION ALL 
      SELECT kabupaten,count(truck_id) from(
      SELECT date_manifest, kabupaten,truck_id from shipping_mtg
      where status = 1
      GROUP BY date_manifest,kabupaten,truck_id) a
      GROUP BY kabupaten) b
      on a.kabupaten = b.kabupaten
JOIN (
select * from ( 
            select 2 as filter,kabupaten_target,COALESCE(total,0) as total from (
                    select shipping_date,kabupaten as kabupaten_total,sum(qty) as total from shipping
                    where status = 1
                    and kabupaten like 'JAKARTA %'
                    GROUP BY kabupaten) a
                    right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target 
                    from bansos_non bn
                    where bn.kabupaten like 'JAKARTA %'
                    group by kabupaten) b
                    on a.kabupaten_total = b.kabupaten_target
            UNION ALL
            select 3 as filter,kabupaten_target,COALESCE(total,0) as total from (
                    select shipping_date,SUBSTRING_INDEX(kabupaten,'KOTA ',-1) as kabupaten_total,COALESCE(sum(qty),0) as total from shipping
                    where status = 1
                    and kabupaten not like 'JAKARTA %'
                    group by kabupaten) a
                    right join (select SUBSTRING_INDEX(bn.kabupaten,'KOTA ',-1) as kabupaten_target,count(bn.id) as target 
                    from bansos_non bn
                    where bn.kabupaten not like 'JAKARTA %'
                    group by kabupaten) b
                    on a.kabupaten_total = b.kabupaten_target
            union ALL
            select 1 as filter,kabupaten_target,COALESCE(total,0) as total from (
                    select s.date_manifest,bn.kabupaten as kabupaten_total,count(bn.id) as total from bansos bn
                    join tb_mtg nm
                    on bn.id = nm.bansos_id
                    join shipping_mtg s
                    on nm.shipping_id = s.id
                    and s.status = 1
                    group by bn.kabupaten) a
                    right join (select bn.kabupaten as kabupaten_target,count(bn.id) as target from bansos bn
                    group by kabupaten) b
                    on a.kabupaten_total = b.kabupaten_target
      ) a
            order by 2,1,3) c
      on a.kabupaten=c.kabupaten_target
    group by kabupaten";
    $query = $this->db->query($sql);
    return $query->result();
  }
}
