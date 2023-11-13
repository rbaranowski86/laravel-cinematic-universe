import React, {useState, useEffect} from 'react';
import {
    Card,
    CardContent,
    Typography,
    Button,
    Box,
    Dialog,
    DialogActions,
    DialogContent,
    DialogTitle,
    TextField
} from '@mui/material';
import {fetchCinematicUniverses, deleteUniverse} from '../services/UniverseService';
import {CinematicUniverse} from "../types";
import {Link} from "react-router-dom";

const HomePage: React.FC = () => {
    const [universes, setUniverses] = useState<CinematicUniverse[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');
    const [openDialog, setOpenDialog] = useState(false);
    const [editingUniverse, setEditingUniverse] = useState<CinematicUniverse | null>(null);

    const loadUniverses = () => {
        setLoading(true);
        fetchCinematicUniverses()
            .then(data => {
                setUniverses(data);
                setLoading(false);
            })
            .catch(err => {
                console.error('Error fetching cinematic universes:', err);
                setError('Failed to load cinematic universes');
                setLoading(false);
            });
    };

    useEffect(() => {
        loadUniverses();
    }, []);

    const handleOpenDialog = (universe: CinematicUniverse | null = null) => {
        setEditingUniverse(universe);
        setOpenDialog(true);
    };

    const handleCloseDialog = () => {
        setOpenDialog(false);
        setEditingUniverse(null);
    };

    const handleSubmit = () => {
        // TODO: Implement Submit functionality
        handleCloseDialog();
    };

    const handleDelete = (universeId) => {
        deleteUniverse(universeId)
            .then(() => {
                loadUniverses();
            })
            .catch(err => {
                console.error('Error deleting universe:', err);
            });
    };

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (
        <Box>
            <Button onClick={() => handleOpenDialog()} variant="contained" color="primary">Add Universe</Button>
            {universes.map(universe => (
                <Card key={universe.id} variant="outlined" sx={{marginBottom: 2}}>
                    <CardContent>
                        <Link to={`/universe/${universe.id}`}>
                            <Typography variant="h5" component="h2">
                                {universe.name}
                            </Typography>
                        </Link>
                        <Typography color="textSecondary">
                            {universe.description}
                        </Typography>
                        <Button onClick={() => handleOpenDialog(universe)}>Edit</Button>
                        <Button onClick={() => handleDelete(universe.id)}>Delete</Button>
                    </CardContent>
                </Card>
            ))}

            {/* Dialog for Adding/Editing Universes */}
            <Dialog open={openDialog} onClose={handleCloseDialog}>
                <DialogTitle>{editingUniverse ? 'Edit Universe' : 'Add Universe'}</DialogTitle>
                <DialogContent>
                    <TextField
                        autoFocus
                        margin="dense"
                        label="Name"
                        type="text"
                        fullWidth
                        defaultValue={editingUniverse?.name}
                    />
                    <TextField
                        margin="dense"
                        label="Description"
                        type="text"
                        fullWidth
                        defaultValue={editingUniverse?.description}
                    />
                    <TextField
                        margin="dense"
                        label="Foundation Year"
                        type="number"
                        fullWidth
                        defaultValue={editingUniverse?.foundationYear}
                    />
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseDialog} color="primary">
                        Cancel
                    </Button>
                    <Button onClick={handleSubmit} color="primary">
                        {editingUniverse ? 'Edit' : 'Add'}
                    </Button>
                </DialogActions>
            </Dialog>
        </Box>
    );
};

export default HomePage;
