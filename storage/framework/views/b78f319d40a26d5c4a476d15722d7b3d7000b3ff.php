

<div class="table-responsive">
	<table class="table table-sm table-striped mg-t-4">
		<tbody>
			<?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<?php
					$desc = str_replace(array("'",'"'),'`',$item->description);
				?>
				
				<?php if($type == 'transfer'): ?>
					<?php if(\App\Items::checkSerial($item->id) == 0): ?>
						<tr class="tx-12" id="id<?php echo e($item->id); ?>">
							<td class="wd-10p"><?php echo e($item->id); ?></td>
							<td class="wd-10p"><?php echo e($item->stock_code); ?></td>
							<td class="wd-30p"><?php echo e($item->description); ?></td>
							<td class="wd-20p"><?php echo e($item->serial_no); ?></td>
							<td class="wd-10p"><?php echo e($item->qty); ?></td>
							<td class="wd-10p"><?php echo e($item->uom); ?></td>
							<td class="wd-10p"><?php echo e($item->cost); ?></td>
							<td class="wd-10p"></td>
							<td class="wd-10p"><a href="#" class="btn btn-xs btn-primary" onclick='addToItem("<?php echo e($item->id); ?>","<?php echo e($item->stock_code); ?>","<?php echo e($desc); ?>","<?php echo e($item->uom); ?>","<?php echo e($item->serial_no); ?>","<?php echo e($item->cost); ?>","<?php echo e($item->qty); ?>");' role="button">Add</a></td>
						</tr>
					<?php endif; ?>
				<?php else: ?>
					<?php if($item->serial_no != '' ): ?>
						<?php if(\App\Items::checkSerial($item->id) == 1): ?>
							<tr class="tx-12" id="id<?php echo e($item->id); ?>">
								<td class="wd-10p"><?php echo e($item->id); ?></td>
								<td class="wd-10p"><?php echo e($item->stock_code); ?></td>
								<td class="wd-30p"><?php echo e($item->description); ?></td>
								<td class="wd-20p"><?php echo e($item->serial_no); ?></td>
								<td class="wd-10p"><?php echo e($item->qty); ?></td>
								<td class="wd-10p"><?php echo e($item->uom); ?></td>
								<td class="wd-10p"><?php echo e($item->cost); ?></td>
								<td class="wd-10p"></td>
								<td class="wd-10p"><a href="#" class="btn btn-xs btn-primary" onclick='addToItem("<?php echo e($item->id); ?>","<?php echo e($item->stock_code); ?>","<?php echo e($desc); ?>","<?php echo e($item->uom); ?>","<?php echo e($item->serial_no); ?>","<?php echo e($item->cost); ?>","<?php echo e($item->qty); ?>");' role="button">Add</a></td>
							</tr>
						<?php endif; ?>
					<?php else: ?>
						<tr class="tx-12" id="id<?php echo e($item->id); ?>">
							<td class="wd-10p"><?php echo e($item->id); ?></td>
							<td class="wd-10p"><?php echo e($item->stock_code); ?></td>
							<td class="wd-30p"><?php echo e($item->description); ?></td>
							<td class="wd-20p"><?php echo e($item->serial_no); ?></td>
							<td class="wd-10p"><?php echo e($item->qty); ?></td>
							<td class="wd-10p"><?php echo e($item->uom); ?></td>
							<td class="wd-10p"><?php echo e($item->cost); ?></td>
							<td class="wd-10p"></td>
							<td class="wd-10p"><a href="#" class="btn btn-xs btn-primary" onclick='addToItem("<?php echo e($item->id); ?>","<?php echo e($item->stock_code); ?>","<?php echo e($desc); ?>","<?php echo e($item->uom); ?>","<?php echo e($item->serial_no); ?>","<?php echo e($item->cost); ?>","<?php echo e($item->qty); ?>");' role="button">Add</a></td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
				<tr><td colspan="5"><center><span class="badge badge-info">Item not found...</span></center></td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>





