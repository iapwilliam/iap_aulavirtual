<table class="table table-striped-columns mt-5">
    <thead class="thead-light">
        <tr>
            <th colspan="3" class="text-center">Currículas del alumno</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Currícula</th>
            <th>Grupo</th> 
        <tr>
    </thead>
    <tbody>
        {foreach from=$activeCourseStudent item=item}
            <tr>
                <td>{$item.courseId}</td>
                <td>{$item.major_name} EN {$item.subject_name}</td>
                <td>{$item.group}</td> 
            </tr>
        {/foreach}
    </tbody>
</table>